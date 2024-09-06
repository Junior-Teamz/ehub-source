<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkshopCollaborator extends Model
{
    use HasFactory;

    protected $fillable = [
        'workshop_id',
        'collaborator_id'
    ];
}
