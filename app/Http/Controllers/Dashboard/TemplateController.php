<?php

namespace App\Http\Controllers\Dashboard;

use App\Constants\DestinationDisk;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Template;
use App\Models\TemplateTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $templates = Template::with('hasTags');
        $keyword = $request->keyword ?? null;
        $params = [];
        if ($keyword) {
            $params['keyword'] = $data['keyword'] = $request->keyword;
            $templates = $templates->where(function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%');
                $query->orWhere('downloads', 'like', '%' . $keyword . '%');
                $query->orWhereHas('hasTags', function ($tag) use ($keyword) {
                    $tag->where('name', 'like', '%' . $keyword . '%');
                });
            });
        }

        $data['templates'] = $templates->latest()->paginate(10)->setPath(route('dashboard.templates.index', $params));
        return view('dashboard.templates.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['tags'] = Tag::where('type', 'template')->get();
        return view('dashboard.templates.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'tag_id' => 'required',
                'file' => 'required|file|max:8192', 
            ]);

            if ($validator->fails()) {
                $inputWithoutStatus = $request->input();
                unset($inputWithoutStatus['status']);
                return back()->withErrors($validator)->withInput($inputWithoutStatus);
            }

            DB::beginTransaction();

            $dataTemplate = [
                'title' => $request->title,
                'description' => $request->description,
                'slug' => Str::slug(preg_replace('/[^\da-z]/i', ' ', $request->title), '-'),
                'status' => $request->status ?? false,
            ];

            $saveTemplate = Template::create($dataTemplate);

            if ($request->hasFile('file')) {
                $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
                $filePath = $request->file('file')->storeAs(DestinationDisk::TEMPLATE_FILE . "/{$saveTemplate->id}", $fileName, 'public');
                $templateFile = '/storage/' . $filePath;
                $currentTemplate = Template::find($saveTemplate->id);
                $currentTemplate->update(['file' => $templateFile]);
            }

            if ($request->has('tag_id')) {
                foreach ($request->tag_id as $tagId) {
                    TemplateTag::create(['tag_id' => $tagId, 'template_id' => $saveTemplate->id]);
                }
            }

            DB::commit();
            Alert::success('Sukses', 'Data berhasil disimpan!');
            return redirect(route('dashboard.templates.index'));
        } catch (\Exception $e) {
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }

            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan teknis, silakan kontak customer service kami');
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
        $data['tags'] = Tag::where('type', 'template')->get();
        $data['template'] = Template::find($id);
        return view('dashboard.templates.edit', $data);
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
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'tag_id' => 'required',
                'file' => 'required|file|max:8192', 
                'description' => 'nullable',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();
            $currentTemplate = Template::find($id);

            $dataTemplate = [
                'title' => $request->title,
                'description' => $request->description,
                'slug' => Str::slug(preg_replace('/[^\da-z]/i', ' ', $request->title), '-'),
                'status' => $request->status ?? false,
            ];

            if ($request->hasFile('file')) {
                if (File::exists(public_path($currentTemplate->file))) {
                    $disk = Storage::disk('public');
                    $disk->deleteDirectory(DestinationDisk::TEMPLATE_FILE . "/{$currentTemplate->id}");
                }
                $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
                $filePath = $request->file('file')->storeAs(DestinationDisk::TEMPLATE_FILE . "/{$currentTemplate->id}", $fileName, 'public');
                $dataTemplate['file'] = '/storage/' . $filePath;
            }

            $currentTemplate->update($dataTemplate);

            if ($request->has('tag_id')) {
                $currentTemplateTag = TemplateTag::where('template_id', $currentTemplate->id);
                $currentTemplateTag->delete();
                foreach ($request->tag_id as $tagId) {
                    TemplateTag::create(['tag_id' => $tagId, 'template_id' => $currentTemplate->id]);
                }
            }

            DB::commit();
            Alert::success('Sukses', 'Data berhasil disimpan!');
            return redirect(route('dashboard.templates.index'));
        } catch (\Exception $e) {
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }

            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan teknis, silakan kontak customer service kami');
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
            $currentTemplate = Template::find($id);
            if ($currentTemplate->delete()) {
                if (File::exists(public_path($currentTemplate->file))) {
                    $disk = Storage::disk('public');
                    $disk->deleteDirectory(DestinationDisk::TEMPLATE_FILE . "/{$currentTemplate->id}");
                }
            }
            DB::commit();
            Alert::success('Sukses', 'Data berhasil dihapus');
            return redirect(route('dashboard.templates.index'));
        } catch (\Exception $e) {
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }

            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan teknis. silakan kontak customer service kami.');
            return back();
        }
    }
}
