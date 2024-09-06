<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JourneySection extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_name',
        'page_id',
    ];

    public function hasPage()
    {
        return $this->belongsTo(JourneyPage::class, 'page_id');
    }

    public function hasLogo()
    {
        return $this->hasMany(JourneyLogo::class, 'section_id');
    }
}
