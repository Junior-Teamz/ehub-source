<?php

namespace App\Models;

use App\Models\Collaborator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'user_id',
        'collaborator_id',
        'phone_number',
        'gender',
        'expertise',
        'status',
        'avatar_url',
        'created_by',
    ];

    public function hasCollaborator()
    {
        return $this->belongsTo(Collaborator::class, 'collaborator_id', 'id');
    }

    public function hasExperts()
    {
        return $this->belongsToMany(Expert::class, 'mentor_experts', 'mentor_id', 'expert_id');
    }

    public function hasUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
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
