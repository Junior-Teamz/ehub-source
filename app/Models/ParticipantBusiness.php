<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantBusiness extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'business_type_id',
        'name',
        'address',
        'nib',
        'nib_created_at',
        'business_site',
        'community',
        'platforms',
        'ig_account',
        'fb_account',
        'tiktok_account'
    ];

    public function hasBusinessType()
    {
        return $this->belongsTo(BusinessType::class, 'business_type_id', 'id');
    }

    public function getPlatformsLabelAttribute()
    {
        $platforms = $this->platforms;

        $explodeString = explode(',', $platforms);

        if (!empty($explodeString)) {
            $contentPlatform = '';
            for ($i = 0; $i < count($explodeString); $i++) {
                if ($i < (count($explodeString) - 1)) {
                    $contentPlatform .= $explodeString[$i] .', ';
                } else {
                    $contentPlatform .= $explodeString[$i];
                }
            }
            $platforms = $contentPlatform;
        }

        return $platforms;
    }
}
