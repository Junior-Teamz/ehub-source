<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_code',
        'name',
        'iso',
        'nicename',
        'iso3',
        'numcode',
        'phonecode'
    ];
}
