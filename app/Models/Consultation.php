<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_id',
        'participant_id',
        'subject',
        'question',
        'logs',
        'is_sent'
    ];
}
