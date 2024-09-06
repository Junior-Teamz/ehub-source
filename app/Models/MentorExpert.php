<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorExpert extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_id',
        'expert_id',
    ];
}
