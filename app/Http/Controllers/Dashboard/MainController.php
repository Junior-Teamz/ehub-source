<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Workshop;
use App\Models\WorkshopParticipant;
use App\Models\Consultation;
use App\Models\Collaborator;
use App\Models\Mentor;
use Carbon\Carbon;

class MainController extends Controller
{
    public function index()
    {
        $entrepreneur_count = User::role('entrepreneur')->count();
        $workshop_count = Workshop::count();
        $collaborator_count = Collaborator::count();
        $mentor_count = Mentor::count();

        // display map
        $store_map_data = [];
        $entrepreneur_by_state = User::query()
                                ->role('entrepreneur')
                                ->select('state')
                                ->selectRaw('COUNT(*) as count')
                                ->groupBy('state')
                                ->get();

        $filteredState = $entrepreneur_by_state->filter(function ($item) {
            return $item['state'] !== null;
        });

        foreach($filteredState as $item) {
            $store_map_data[] = [
                'name' => stateByName($item->state) . ' ('. $item->count .')',
                'coords' => getCoordinate($item->state)
            ];
        }

        $favWorkshops = Workshop::join('workshop_participants', 'workshop_participants.workshop_id', '=', 'workshops.id')
            ->select(
                'workshops.title',
                \DB::raw('count(workshop_participants.workshop_id) as count')
            )
            ->groupBy('workshops.id')
            ->orderByDesc('count')
            ->limit(3)
            ->get();

        $favMentors = Mentor::join('consultations', 'consultations.mentor_id', '=', 'mentors.id')
            ->select(
                'mentors.avatar_url',
                'mentors.fullname',
                'mentors.expertise',
                \DB::raw('count(consultations.mentor_id) as count')
            )
            ->groupBy('mentors.id')
            ->orderByDesc('count')
            ->limit(3)
            ->get();

        // $quarterGeneral = [0, 0, 0, 0];
        // $quarterCandidate = [0, 0, 0, 0];
        // $quarterStarter = [0, 0, 0, 0];
        // $quarterExpert = [0, 0, 0, 0];
        // $currentYear = Carbon::now()->year;

        // for ($quarter = 1; $quarter <= 4; $quarter++) {
        //     $startDate = Carbon::create($currentYear, ($quarter - 1) * 3 + 1, 1)->startOfDay();
        //     $endDate = $startDate->copy()->addMonths(3)->endOfDay();

        //     $general = User::role('entrepreneur')->whereHas('hasParticipant', function($query) {
        //         $query->whereHas('hasBusiness', function($query) {
        //             $query->where('name', '==', null);
        //         });
        //     })->whereBetween('created_at', [$startDate, $endDate])->count();
        //     $candidate = User::role('entrepreneur')->whereHas('hasParticipant', function($query) {
        //         $query->whereHas('hasBusiness', function($query) {
        //             $query->where([
        //                 ['name', '!=', null],
        //                 ['nib_created_at', null],
        //             ]);
        //         });
        //     })->whereBetween('created_at', [$startDate, $endDate])->count();
        //     $starter = User::role('entrepreneur')->whereHas('hasParticipant', function($query) {
        //         $query->whereHas('hasBusiness', function($query) {
        //             $query->where([
        //                 ['business_type_id', '!=', 0],
        //                 ['nib', '!=', null],
        //                 ['nib_created_at', '>', now()->year - 3],
        //             ]);
        //         });
        //     })->whereBetween('created_at', [$startDate, $endDate])->count();
        //     $expert = User::role('entrepreneur')->whereHas('hasParticipant', function($query) {
        //         $query->whereHas('hasBusiness', function($query) {
        //             $query->where([
        //                 ['business_type_id', '!=', 0],
        //                 ['nib', '!=', null],
        //                 ['nib_created_at', '<=', now()->year - 3],
        //             ]);
        //         });
        //     })->whereBetween('created_at', [$startDate, $endDate])->count();
        //     $quarterGeneral[$quarter - 1] = $general;
        //     $quarterCandidate[$quarter - 1] = $candidate;
        //     $quarterStarter[$quarter - 1] = $starter;
        //     $quarterExpert[$quarter - 1] = $expert;
        // }

        // $business = User::role('entrepreneur')
        // ->withCount([
        //     'hasParticipant as general_entrepreneur' => function ($query) {
        //         $query->select(\DB::raw('COUNT(*)'))->whereHas('hasBusiness', function ($query) {
        //             $query->where('name', '==', null);
        //         });
        //     },
        //     'hasParticipant as candidate_entrepreneur' => function ($query) {
        //         $query->select(\DB::raw('COUNT(*)'))->whereHas('hasBusiness', function ($query) {
        //             $query->where([
        //                 ['name', '!=', null],
        //                 ['nib_created_at', null],
        //             ]);
        //         });
        //     },
        //     'hasParticipant as starter_entrepreneur' => function ($query) {
        //         $query->select(\DB::raw('COUNT(*)'))->whereHas('hasBusiness', function ($query) {
        //             $query->where([
        //                 ['business_type_id', '!=', 0],
        //                 ['nib', '!=', null],
        //                 ['nib_created_at', '>', now()->year - 3],
        //             ]);
        //         });
        //     },
        //     'hasParticipant as expert_entrepreneur' => function ($query) {
        //         $query->select(\DB::raw('COUNT(*)'))->whereHas('hasBusiness', function ($query) {
        //             $query->where([
        //                 ['business_type_id', '!=', 0],
        //                 ['nib', '!=', null],
        //                 ['nib_created_at', '<=', now()->year - 3],
        //             ]);
        //         });
        //     },
        //     'hasParticipant as small_age_count' => function ($query) {
        //         $query->select(\DB::raw('COUNT(*)'))->whereHas('hasBusiness', function ($query) {
        //             $query->where('nib_created_at', '>', now()->year - 3);
        //         });
        //     },
        //     'hasParticipant as large_age_count' => function ($query) {
        //         $query->select(\DB::raw('COUNT(*)'))->whereHas('hasBusiness', function ($query) {
        //             $query->where('nib_created_at', '<=', now()->year - 3);
        //         });
        //     },
        //     'hasParticipant as nib_count' => function ($query) {
        //         $query->select(\DB::raw('COUNT(*)'))->whereHas('hasBusiness', function ($query) {
        //             $query->whereNotNull('nib');
        //         });
        //     },
        //     'hasParticipant as nib_null_count' => function ($query) {
        //         $query->select(\DB::raw('COUNT(*)'))->whereHas('hasBusiness', function ($query) {
        //             $query->whereNull('nib');
        //         });
        //     },
        //     'hasParticipant as tokopedia_count' => function ($query) {
        //         $query->select(\DB::raw('COUNT(*)'))->whereHas('hasBusiness', function ($query) {
        //             $query->where('platforms', 'LIKE', '%tokopedia%');
        //         });
        //     },
        //     'hasParticipant as bukalapak_count' => function ($query) {
        //         $query->select(\DB::raw('COUNT(*)'))->whereHas('hasBusiness', function ($query) {
        //             $query->where('platforms', 'LIKE', '%bukalapak%');
        //         });
        //     },
        //     'hasParticipant as shopee_count' => function ($query) {
        //         $query->select(\DB::raw('COUNT(*)'))->whereHas('hasBusiness', function ($query) {
        //             $query->where('platforms', 'LIKE', '%shopee%');
        //         });
        //     },
        //     'hasParticipant as lazada_count' => function ($query) {
        //         $query->select(\DB::raw('COUNT(*)'))->whereHas('hasBusiness', function ($query) {
        //             $query->where('platforms', 'LIKE', '%lazada%');
        //         });
        //     },
        // ])->get();
        // $pieResult = [$business->sum('small_age_count'), $business->sum('large_age_count')];
        // $nibResult = [$business->sum('nib_count'), $business->sum('nib_null_count')];
        // $platformResult = [$business->sum('tokopedia_count'), $business->sum('bukalapak_count'), $business->sum('shopee_count'), $business->sum('lazada_count')];
        // $entrepreneurResult = [$business->sum('general_entrepreneur'), $business->sum('candidate_entrepreneur'), $business->sum('starter_entrepreneur'), $business->sum('expert_entrepreneur')];

        $data['dashboard'] = (object)[
            'statistics' => (object)[
                (object)[
                    'name' => 'Wirausaha',
                    'count' => $entrepreneur_count,
                ],
                (object)[
                    'name' => 'Program',
                    'count' => $workshop_count,
                ],
                (object)[
                    'name' => 'Kolaborator',
                    'count' => $collaborator_count,
                ],
                (object)[
                    'name' => 'Mentor',
                    'count' => $mentor_count,
                ],
            ],
            // 'graphic_data' => (object)[
            //     'general' => $quarterGeneral,
            //     'candidate' => $quarterCandidate,
            //     'starter' => $quarterStarter,
            //     'expert' => $quarterExpert,
            // ],
            // 'pie_data' => (object)[
            //     'entrepreneur' => $entrepreneurResult,
            //     'pie' => $pieResult,
            //     'nib' => $nibResult,
            //     'platform' => $platformResult,
            // ],
            'map_data' => $store_map_data,
            'favourite' => (object)[
                'workshops' => $favWorkshops,
                'mentors' => $favMentors
            ]
        ];

        return view('dashboard.main', $data);
    }
}
