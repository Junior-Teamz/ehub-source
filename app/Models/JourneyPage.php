<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JourneyPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_name',
    ];

    public function hasSection()
    {
        return $this->hasMany(JourneySection::class, 'page_id');
    }

    public function hasLogo()
    {
        return $this->hasMany(JourneyLogo::class, 'page_id');
    }
}
