<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkshopTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'workshop_id',
        'tag_id'
    ];
}
