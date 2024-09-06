<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{News, Tag, NewsTag};
use App\Models\Workshop;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $news = News::query();
        $nextNews = News::query();
        
        if ($request->has('search')) {
            $keyword = $request->input('search');
            $news->where('title', 'LIKE', '%'.$keyword.'%');
        }

        $data['hastags'] = News::with(['hasTags'])->get();
        $data['populars'] = News::where('status', 'publish')->orderByDesc('viewer')->limit(10)->get();
        $data['news'] = $news->where('status', 'publish')->latest()->get();
        $data['nextNews'] = $nextNews->where('status', 'publish')->latest()->offset(4)->paginate(10);
    
        $data['workshops'] = Workshop::with(['hasTags', 'hasTargets'])->where('status', 'publish')->latest()->get();
        return view('landing.news.index', $data);
    }

    public function detail($slug)
    {
        $workshops = Workshop::with(['hasTags', 'hasTargets'])->where('status', 'publish')->latest()->get();
        $current_news = News::where('slug', $slug)->first();
        $current_news->update(['viewer' => ($current_news->viewer + 1)]);
        if (!$current_news) {
            return abort(404);
        }
        // Ambil tag_id dari artikel tersebut
        $tag_id = $current_news->hasTags[0]->id;
        // Ambil artikel lain yang memiliki tag_id yang sama
        $relatedNews = News::where('status', 'publish')->whereHas('hasTags', function ($query) use ($tag_id) {
            $query->where('tag_id', $tag_id);
            })
            ->where('id', '!=', $current_news->id)
            ->limit(3)
            ->get();
        $news = News::latest()->get();
        $hastags = News::with(['hasTags'])->get();
        $populars = News::where('status', 'publish')->orderByDesc('viewer')->get();
        $news_item = News::where('slug', $slug)->firstOrFail();
            // Jika artikel ditemukan, tampilkan halaman detail
        if (!$news_item) {
        // Jika artikel tidak ditemukan, tampilkan halaman 404
            return abort(404);
        }
        return view('landing.news.detail', ['news_item' => $news_item], compact('news','news_item','populars','relatedNews', 'workshops'));
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
    public function show($id)
    {
       
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
}
