<?php

namespace App\Http\Controllers\Dashboard;

use App\Constants\DestinationDisk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{Collaborator, News, Tag, NewsTag};
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentUser = auth()->user();
        $userOwner = $currentUser->created_by != 0 ? $currentUser->created_by : $currentUser->id;

        $news = News::query();
        
        if (Auth::user()->hasRole(['collaborator', 'institution'])) {
            $news->where('created_by', $userOwner);
        }

        $keyword = $data['keyword'] = $params['keyword'] = $request->keyword ?? null;
        $data['hastags'] = News::with(['hasTags'])->get();
        $data['populars'] = News::all()->sortByDesc('viewer');

        if ($request->keyword) {
            $news->where(function(Builder $query) use ($keyword) {
                $query->where('title', 'LIKE', '%'.$keyword.'%');
                $query->orWhereHas('hasTags', function($tag) use ($keyword) {
                    $tag->where('name', 'LIKE', '%'.$keyword.'%');
                });
                $query->orWhereHas('hasUser', function($user) use ($keyword) {
                    $user->whereHas('hasCollaborator', function($collaborator) use ($keyword) {
                        $collaborator->where('name', 'LIKE', '%'.$keyword.'%');
                    });
                });
            });
        }
        $data['news'] = $news->latest()->paginate(10)->setPath(route('dashboard.news.index', $params));

        if (session('success')) {
            $data['successMessage'] = session('success');
        }

        return view('dashboard.news.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::where('type', 'news')->get();
        $selectedTags = [];
        $collaborators = Collaborator::where('status', true)->get();
        View::share('tags', $tags);
        return view('dashboard.news.create', compact('tags','selectedTags', 'collaborators'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentUser = auth()->user();
        $userOwner = $currentUser->id;
        if (auth()->user()->hasRole('admin')) {
            $userOwner = $request->created_by;
        } else {
            $userOwner = $currentUser->created_by != 0 ? $currentUser->created_by : $currentUser->id;
        }
        
        try {
            $news = new News();

            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'content' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:8192',
                'status' => 'required',
                'tags' => 'required|array',
                'tags.*' => 'exists:tags,id',
                'created_by' => auth()->user()->hasRole('admin') ? 'required' : 'nullable',
            ]);

            if ($validator->fails()) {
                $inputWithoutStatus = $request->input();
                unset($inputWithoutStatus['status']);
                return back()->withErrors($validator)->withInput($inputWithoutStatus);
            }

            DB::beginTransaction();

            $news->title = $request->title;
            $news->content = $request->content;
            $news->status = $request->status;
            $news->created_by = $userOwner;
            $news->url_thumbnail = 'https://ehub.kemenkopukm.go.id/images/news/placeholder.png';
            $news->slug = Str::slug($request->title);
            $news->save();

            if ($request->hasFile('image')) {
                $fileName = time().'_'.$request->file('image')->getClientOriginalName();
                $filePath = $request->file('image')->storeAs(DestinationDisk::NEWS_THUMBNAIL . "/{$news->id}", $fileName, 'public');
                $newsThumbnail = '/storage/' . $filePath;
                $news->update(['url_thumbnail' => $newsThumbnail]);
            }

            if ($request->tags) {
                $news->hasTags()->sync($request->tags);
            } else {
                $news->hasTags()->sync([]);
            }

            DB::commit();

            if ($request->status == 'ready') {
                session()->flash('success', 'Berita berhasil dikirim. Menunggu validasi dari Pusat Informasi!');
            } else {
                session()->flash('success', 'Berita berhasil ditambahkan!');
            }

            return redirect()->route('dashboard.news.index');
        } catch (\Exception $e) {
            DB::rollBack();
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }
            session()->flash('technical_error', 'Terjadi kesalahan teknis. Silakan hubungi customer service kami!');
            return back();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);
        $tags = Tag::where('type', 'news')->get();
        $selectedTags = $news->hasTags->pluck('id')->toArray();
        $collaborators = Collaborator::where('status', true)->get();
        return view('dashboard.news.edit', compact('news','tags', 'selectedTags', 'collaborators'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $currentUser = auth()->user();
        $userOwner = $currentUser->id;
        if (auth()->user()->hasRole('admin')) {
            $userOwner = $request->created_by;
        } else {
            $userOwner = $currentUser->created_by != 0 ? $currentUser->created_by : $currentUser->id;
        }
        
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'content' => 'required',
                'image' =>  $request->hasFile('image') ? 'required|image|mimes:jpeg,png,jpg,gif|max:8192' : 'nullable',
                'status' => 'required',
                'tags' => 'required|array',
                'tags.*' => 'exists:tags,id',
                'created_by' => Auth::user()->hasRole('admin') ? 'required' : 'nullable',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();
            $news = News::findOrFail($id);
            $news->fill([
                'title' => $request->title,
                'content' => $request->content,
                'status' => $request->status,
                'slug' => Str::slug($request->title),
                'created_by' => $userOwner
            ]);

            if ($request->hasFile('image')) {
                $fileName = time().'_'.$request->file('image')->getClientOriginalName();
                $filePath = $request->file('image')->storeAs(DestinationDisk::NEWS_THUMBNAIL . "/{$news->id}", $fileName, 'public');
                $newsThumbnail = '/storage/' . $filePath;
                $news->url_thumbnail = $newsThumbnail;
            }

            $news->save();

            $selectedTags = $request->input('tags', []);
            $news->hasTags()->sync($selectedTags);
            DB::commit();
            session()->flash('success', 'Berita berhasil diubah!');
            return redirect()->route('dashboard.news.index');
        } catch (\Exception $e) {
            DB::rollBack();
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }
            session()->flash('technical_error', 'Terjadi kesalahan teknis. Silakan hubungi customer service kami!');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $news = News::findOrFail($id);
            if (!empty($news->url_thumbnail)) {
                $imagePath = public_path($news->url_thumbnail);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
            $news->delete();
            DB::commit();
            session()->flash('success', 'Kabar berhasil dihapus!');
            return redirect()->route('dashboard.news.index');
        } catch (\Exception $e) {
            DB::rollBack();
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }
            session()->flash('technical_error', 'Terjadi kesalahan teknis. Silakan hubungi customer service kami!');
            return back();
        }
    }
}
