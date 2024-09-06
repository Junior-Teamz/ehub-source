<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\News;
use App\Models\Workshop;
use App\Models\WorkshopParticipant;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $workshops = Workshop::query();
        $workshops->where('status', 'publish');
        if ($request->has('search')) {
            $keyword = $request->input('search');

            $workshops->where(function ($query) use ($keyword) {
                $query->where('title', 'LIKE', '%' . $keyword . '%')
                    ->orWhereHas('hasCollaborators', function ($subQuery) use ($keyword) {
                        $subQuery->where('name', 'LIKE', '%' . $keyword . '%');
                    });
            });
        }

        $data['workshops'] = $workshops->latest()->get();
        $data['news'] = News::where('status', 'publish')->latest()->get();
        return view('landing.workshops.index', $data);
    }

    public function detail($slug)
    {
        $data['is_registered'] = false;

        $data['workshop'] = Workshop::with(['hasTargets', 'hasParticipants'])->where(['slug' => $slug, 'status' => 'publish'])->firstOrFail();
        $data['workshops'] = Workshop::where('slug', '!=', $slug)->where('status', 'publish')->latest()->get();

        if (auth()->check()) {
            $currentUser = Auth::user();
            $data['is_registered'] = $data['workshop']->hasParticipants->contains('user_id', $currentUser->id);
            $data['is_contacted'] =  $data['workshop']->hasParticipants->isNotEmpty() ? $data['workshop']->hasParticipants->first()->hasWorkshopParticipants->first()->status === 'contacted' : false;
        }

        return view('landing.workshops.detail', $data);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function follow($slug)
    {
        try {
            $currentUser = Auth::user();
            $currentWorkshop = Workshop::where('slug', $slug)->first();

            WorkshopParticipant::create([
                'workshop_id' => $currentWorkshop->id,
                'participant_id' => $currentUser->hasParticipant->id
            ]);

            Alert::success('Sukses', 'Anda telah terdaftar diprogram ' . $currentWorkshop->title . ', tunggu konfirmasi lebih lanjut');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan teknis, silahkan kontak customer service kami');
            return redirect()->back();
        }
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
