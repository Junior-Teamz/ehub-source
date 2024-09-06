<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'state_code',
        'city_code',
        'city_name'
    ];

    public function getCityNameAttribute($value)
    {
        $explode_string = explode(" ", Str::lower($value));
        $uc_first_format = [];
        for ($i = 0; $i < count($explode_string); $i++) {
            $uc_first_format[] = Str::ucfirst($explode_string[$i]);
        }
        $value = implode(" ", $uc_first_format);

        return $value;
    }
}
