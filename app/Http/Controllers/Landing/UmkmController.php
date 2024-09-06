<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Collaborator;
use App\Models\News;
use App\Models\Tag;
use App\Models\Workshop;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $data['keyword'] = $params['keyword'] = $request->keyword ?? null;
        $filterCategory = $data['filterCategory'] = $params['filterCategory'] = $request->filterCategory ?? null;
        $perPage = $request->perPage ?? 10;
        $collaborators = Collaborator::where('status', true);

        if ($keyword) {
            $collaborators->where(function (Builder $collaborator) use ($keyword) {
                $collaborator->where('name', 'LIKE', '%' . $keyword . '%');
                $collaborator->orWhereHas('hasTags', function ($tag) use ($keyword) {
                    $tag->where('name', 'LIKE', '%' . $keyword . '%');
                });
                $collaborator->orWhere('description', 'LIKE', '%' . $keyword . '%');
            });
        }

        if ($filterCategory) {
            $collaborators = $collaborators->whereHas('hasTags', function ($query) use ($filterCategory) {
                $query->whereIn('name', $filterCategory);
            });
        }

        $data['tags'] = Tag::where('type', 'collaborator')->get();
        $data['collaborators'] = $collaborators->latest()->paginate($perPage)->setPath(route('umkm.index', $params));
        $data['news'] = News::where('status', 'publish')->latest()->limit(9)->get();
        return view('landing.umkm.index', $data);
    }

    public function detail(Request $request, $slug)
    {
        $type = $request->input('type');

        $data['content'] = [];
        $workshops = Workshop::latest()->get();
        $currentCollaborator = Collaborator::where('slug', $slug)->first();

        if ($type === 'mentors') {
            $data['content'] = $currentCollaborator->hasMentors->where('status', true);
        } else {
            $data['content'] = $currentCollaborator->hasWorkshops->where('status', 'publish');
        }

        $data['collaborator'] = $currentCollaborator;
        $data['count'] = (object) [
            'workshops' => count($currentCollaborator->hasWorkshops->where('status', 'publish')),
            'mentors' => count($currentCollaborator->hasMentors->where('status', true)),
        ];

        return view('landing.umkm.detail', $data);
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
