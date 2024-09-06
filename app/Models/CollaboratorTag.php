<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollaboratorTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'collaborator_id',
        'tag_id'
    ];
}
