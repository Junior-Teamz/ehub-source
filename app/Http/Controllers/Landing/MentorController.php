<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Collaborator;
use App\Models\Consultation;
use App\Models\Expert;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class MentorController extends Controller
{
    protected $routeIndex = 'mentor';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $filterCollaborator = $data['filterCollaborator'] = $params['filterCollaborator'] = $request->filterCollaborator ?? null;
        $filterSector = $data['filterSector'] = $params['filterSector'] = $request->filterSector ?? null;
        $perPage = $request->perPage ?? 10;
        $mentors = Mentor::where('status', true);
        $data['collaborators'] = Collaborator::where('status', true)
            ->orderBy('created_at', 'desc')
            ->get();

        // Fungsi untuk mengambil semua kolaborator yang diurutkan sesuai abjad
        $data['allCollaborators'] = Collaborator::where('status', true)
            ->orderBy('name', 'asc')
            ->get();

        if ($keyword) {
            $mentors = $mentors->where(function ($query) use ($keyword) {
                $query->where('fullname', 'like', '%' . $keyword . '%')
                    ->orWhere('expertise', 'like', '%' . $keyword . '%')
                    ->orWhereHas('hasCollaborator', function ($collaboratorQuery) use ($keyword) {
                        $collaboratorQuery->where('name', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('hasExperts', function ($expertsQuery) use ($keyword) {
                        $expertsQuery->where('name', 'like', '%' . $keyword . '%');
                    });
            });
        }

        $data['isFiltered'] = false;

        if ($filterCollaborator) {
            $mentors = $mentors->whereIn('collaborator_id', $filterCollaborator);
            $data['isFiltered'] = true;
        }

        if ($filterSector) {
            $mentors = $mentors->whereHas('hasExperts', function ($query) use ($filterSector) {
                $query->whereIn('name', $filterSector);
            });
            $data['isFiltered'] = true;
        }
        $data['mentors'] = $mentors->latest()->paginate($perPage)->appends(['keyword' => $keyword]);
        $data['experts'] = Expert::all();
        return view('landing.mentor.index', $data);
    }

    /**
     * Display the specified resource.
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
        try {
            if (auth()->check()) {
                if (is_profile_updated()) {
                    $validator = Validator::make($request->all(), [
                        'subject' => 'required',
                        'question' => 'required',
                    ]);
                    if ($validator->fails()) {
                        Alert::error('Error', 'Ada data yang kosong, silakan lengkapi dahulu!');
                        return back()->withInput();
                    }
                    DB::beginTransaction();

                    $currentUser = Auth::user();
                    $data['user'] = $currentUser;
                    $data['mentor'] = $mentor = Mentor::find($request->mentor_id);
                    $data['subject'] = $request->subject;
                    $data['question'] = $request->question;
                    $consultation = Consultation::all();
                    Mail::send('landing.mentor.email', $data, function ($message) use ($consultation, $data) {
                        $message->to([config('app.consultation_email'), $data['mentor']->hasUser->email]);
                        $message->subject('Konsultasi EHub ke ' . (count($consultation) + 1) . ' - {' . $data['mentor']->fullname . '}');
                    });
                    if (count(Mail::failures()) > 0) {
                        Alert::error('Error', 'Pertanyaan gagal terkirim. Silakan kontak customer service kami');
                        return back();
                    } else {
                        $dataLog = [
                            'subject' => 'Konsultasi EHub ke ' . (count($consultation) + 1) . ' - {' . $data['mentor']->fullname . '}',
                            'title' => $request->subject,
                            'question' => $request->question,
                            'is_sent' => true,
                            'receiver' => config('app.consultation_email'),
                            'datetime_sent' => now(),
                            'participant' => $currentUser->hasParticipant,
                            'mentor' => $data['mentor'],
                        ];
                        $dataConsultation = [
                            'mentor_id' => $request->mentor_id,
                            'participant_id' => $currentUser->hasParticipant->id,
                            'subject' => $request->subject,
                            'question' => $request->question,
                            'logs' => json_encode($dataLog),
                            'is_sent' => true,
                        ];
                        $saveConsultation = Consultation::create($dataConsultation);
                        Alert::success('Pertanyaan berhasil terkirim!', 'Tunggu jawaban dari kami, kami akan menghubungi anda segera!');
                    }

                    DB::commit();
                    return redirect(route('mentors.index'));
                } else {
                    Alert::info('Informasi', 'Lengkapi dulu profil anda!');
                    return redirect(route('profile.edit', ['next_name' => 'mentors']));
                }
            } else {
                Alert::info('Informasi', 'Anda harus login terlebih dahulu!');
                return redirect(route('login'));
            }
        } catch (\Exception $e) {
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }

            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan teknis, silahkan kontak customer service kami');
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
