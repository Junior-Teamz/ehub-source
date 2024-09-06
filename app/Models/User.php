<?php

namespace App\Models;

use App\Models\ParticipantUser;
use App\Models\ParticipantBusiness;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'email',
        'id_card',
        'phone',
        'gender',
        'born_date',
        'born_place',
        'photo',
        'photo_url',
        'country',
        'state',
        'city',
        'sector',
        'village',
        'zip_code',
        'address',
        'token',
        'password',
        'email_verified_at',
        'is_verification_mail_sent',
        'created_by',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasParticipant()
    {
        return $this->hasOne(ParticipantUser::class, 'user_id', 'id');
    }

    public function hasCollaborator()
    {
        return $this->hasOne(Collaborator::class, 'user_id', 'id');
    }

    public function hasCreatedBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function getEntrepreneurCategoryAttribute($entrepreneur_id)
    {
        $result = 'Masyarakat Umum';
        $entrepreneurInfo = User::find($entrepreneur_id);
        
        $participantInfo = $entrepreneurInfo->hasParticipant ?? false;
        $businessInfo = $participantInfo->hasBusiness ?? false;

        if ($participantInfo && $businessInfo) {
            $candidateEntrepreneur = $businessInfo->name != null;
            $starterEntrepreneur = $businessInfo->business_type_id != 0 && $businessInfo->nib != null && ($businessInfo->nib_created_at != null && (now()->year - $businessInfo->nib_created_at) < 3);
            $expertEntrepreneur = $businessInfo->business_type_id != 0 && $businessInfo->nib != null && ($businessInfo->nib_created_at != null && (now()->year - $businessInfo->nib_created_at) >= 3);

            if ($candidateEntrepreneur) {
                $result = 'Calon Wirausaha';
            }
            
            if ($starterEntrepreneur) {
                $result = 'Wirausaha Pemula';
            }
            
            if ($expertEntrepreneur) {
                $result = 'Wirausaha Mapan';
            }
        }

        return $result;
    }

    public function getActiveLabelAttribute()
    {
        $status = $this->is_active;

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
