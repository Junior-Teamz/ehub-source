<?php

namespace App\Models;

use App\Models\City;
use App\Models\Mentor;
use App\Models\State;
use App\Models\Workshop;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'logo_url',
        'cover_url',
        'name',
        'director_name',
        'state_id',
        'city_id',
        'address',
        'description',
        'status',
        'phone_number',
        'slug',
        'site',
    ];

    public function hasWorkshops()
    {
        return $this->belongsToMany(Workshop::class, 'workshop_collaborators', 'collaborator_id', 'workshop_id');
    }

    public function hasMentors()
    {
        return $this->hasMany(Mentor::class, 'collaborator_id', 'id');
    }

    public function hasTags()
    {
        return $this->belongsToMany(Tag::class, 'collaborator_tags', 'collaborator_id', 'tag_id');
    }

    public function hasUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function hasState()
    {
        return $this->belongsTo(State::class, 'state_id', 'state_code');
    }

    public function hasCity()
    {
        return $this->belongsTo(City::class, 'city_id', 'city_code');
    }

    public function getStatusLabelAttribute()
    {
        $status = $this->status;

        $type = null;
        $value = null;

        switch ($status) {
            case true:
                $type = 'success';
                $value = 'Aktif';
                break;
            case false:
                $type = 'danger';
                $value = 'Tidak Aktif';
                break;
            default:
                $type = 'danger';
                $value = 'Tidak Aktif';
                break;
        }

        return (object) [
            'type' => $type,
            'value' => $value,
        ];
    }
}
