<?php

namespace App\Models;

use App\Models\ParticipantBusiness;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Workshop;

class ParticipantUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fullname',
        'avatar_url',
        'phone_number',
        'born_place',
        'born_date',
        'gender',
        'state_code',
        'city_code',
        'sector_code',
        'village_code',
    ];

    public function hasWorkshops()
    {
        return $this->belongsToMany(Workshop::class, 'workshop_participants', 'participant_id', 'workshop_id');
    }

    public function hasUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function hasWorkshopParticipants()
    {
        return $this->hasMany(WorkshopParticipant::class, 'participant_id', 'id');
    }

    public function hasBusiness()
    {
        return $this->hasOne(ParticipantBusiness::class, 'participant_id', 'id');
    }

    public function hasState()
    {
        return $this->belongsTo(State::class, 'state_code', 'state_code');
    }

    public function hasCity()
    {
        return $this->belongsTo(City::class, 'city_code', 'city_code');
    }

    public function hasSector()
    {
        return $this->belongsTo(Sector::class, 'sector_code', 'sector_code');
    }

    public function hasVillage()
    {
        return $this->belongsTo(Village::class, 'village_code', 'village_code');
    }


    public function getGenderLabelAttribute() 
    {
        $gender = $this->gender;
        $value = null;

        switch ($gender) {
            case 'female' : 
                $value = 'Perempuan';
                break;
            case 'male' : 
                $value = 'Laki Laki';
                break;
            default : 
                $value = '-';
                break;
        }

        return (object)[
            'value' => $value
        ];
    }
}
