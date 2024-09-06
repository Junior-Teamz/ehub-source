<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Template;
use App\Models\TemplateLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['tags'] = Tag::where('type', 'template')->get();
        $templates = Template::with('hasTags')->where('status', true);
        $keyword = $data['keyword'] = $request->keyword ?? null;
        $category = $data['category'] = $request->category ?? null;
        $params = [];
        if ($category) {
            $params['category'] = $request->category;
            $templates = $templates->whereHas('hasTags', function($query) use ($category) {
                $query->where('name', $category);
            });
        }

        if ($keyword) {
            $params['keyword'] = $request->keyword;
            $templates = $templates->where( function ($query) use ($keyword) {
                $query->where('title', 'like', '%'.$keyword.'%');
                $query->orWhereHas('hasTags', function($tag) use ($keyword) {
                    $tag->where('name', 'like', '%'.$keyword.'%');
                });
            });
        }

        $data['templates'] = $templates->latest()->paginate(10)->setPath(route('templates.index', $params));
        return view('landing.templates.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $isJson = $request->has('isJson') && $request->input('isJson') === 'true';
        $data['template'] = Template::with('hasTags')->where('id', $id)->first();
        return $isJson ? response()->json($data['template']) : redirect(route('templates.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function download($id)
    {
        try {
            DB::beginTransaction();
            $template = Template::find($id);
            $downloadTotal = $template->downloads ?? 0;
            $logs = TemplateLog::where(['template_id' => $template->id, 'user_id' => Auth::user()->id])->first();
            if (is_null($logs)) {
                $saveLog = TemplateLog::create(['template_id' => $template->id, 'user_id' => Auth::user()->id, 'downloads' => 1]);
                $downloadTotal = $downloadTotal + 1;
            } else {
                $updateUserDownloads = $logs->downloads + 1;
                $logs->update(['downloads' => $updateUserDownloads]);
            }
            $template->update(['downloads' => $downloadTotal]);
            DB::commit();
            return sendApiResponse(true, 'Berhasil download', ['template' => $template], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }
            return sendApiResponse(false, 'Terjadi kesalahan teknis, silakan kontak customer service kami', ['error' => $e], 500);
        }
    }
}
