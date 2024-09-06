<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JourneyLogo extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo_name',
        'url_logo',
        'status',
        'website',
        'page_id',
        'section_id',
    ];

    public function hasPage()
    {
        return $this->belongsTo(JourneyPage::class, 'page_id');
    }

    public function hasSection()
    {
        return $this->belongsTo(JourneySection::class, 'section_id');
    }
}
