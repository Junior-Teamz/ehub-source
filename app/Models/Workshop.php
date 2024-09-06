<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use App\Models\Target;
use App\Models\ParticipantUser;
use App\Models\WorkshopParticipant;
use App\Models\Collaborator;

class Workshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'thumbnail',
        'description',
        'organizer',
        'organizer_image',
        'material_links',
        'place',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'quota',
        'registrant_total',
        'registrant_accepted',
        'status',
        'created_by',
        'state_id',
        'city_id',
        'address'
    ];

    public function hasTags()
    {
        return $this->belongsToMany(Tag::class, 'workshop_tags', 'workshop_id', 'tag_id');
    }

    public function hasTargets()
    {
        return $this->belongsToMany(Target::class, 'workshop_targets', 'workshop_id', 'target_id');
    }

    public function hasParticipants()
    {
        return $this->belongsToMany(ParticipantUser::class, 'workshop_participants', 'workshop_id', 'participant_id');
    }

    public function hasCollaborators()
    {
        return $this->belongsToMany(Collaborator::class, 'workshop_collaborators', 'workshop_id', 'collaborator_id');
    }

    public function hasState()
    {
        return $this->belongsTo(State::class, 'state_id', 'state_code');
    }

    public function hasCity()
    {
        return $this->belongsTo(City::class, 'city_id', 'city_code');
    }

    public function getLabelAttribute()
    {
        $currentUser = Auth::user();
        $currentParticipant = ParticipantUser::where('user_id', $currentUser->id)->first();
        $workshopId = $this->id;

        $workshopPivot = WorkshopParticipant::where([
            ['workshop_id', $workshopId],
            ['participant_id', $currentParticipant->id]
        ])->first();

        $type = null;
        $value = null;

        switch ($workshopPivot->status) {
            case 'registered':
                $type = 'success';
                $value = 'diterima';
                break;

            case 'rejected':
                $type = 'warning';
                $value = 'ditolak';
                break;

            default:
                $type = 'warning';
                $value = 'menunggu';
                break;
        }

        return (object)[
            'type' => $type,
            'value' => $value
        ];
    }

    public function getStatusLabelAttribute()
    {
        $status = $this->status;

        $type = null;
        $value = null;

        switch ($status) {
            case 'unpublish' :
                $type = 'warning';
                $value = 'Draft';
                break;
            case 'ready' :
                $type = 'info';
                $value = 'Menunggu validasi dari pusat informasi!';
                break;
            case 'publish' :
                $type = 'success';
                $value = 'Publish';
                break;
            case 'finish' :
                $type = 'success';
                $value = 'Selesai';
                break;
            case 'inactive' :
                $type = 'danger';
                $value = 'Tidak Aktif';
                break;
            default :
                $type = 'warning';
                $value = 'Draft';
                break;
        }

        return (object)[
            'type' => $type,
            'value' => $value
        ];
    }
}
