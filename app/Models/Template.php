<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'file',
        'slug',
        'downloads',
        'status'
    ];

    public function hasTags()
    {
        return $this->belongsToMany(Tag::class, 'template_tags', 'template_id', 'tag_id');
    }

    public function hasLogs()
    {
        return $this->hasMany(TemplateLog::class, 'template_id', 'user_id');
    }

    public function getStatusLabelAttribute() 
    {
        $status = $this->status;

        $type = null;
        $value = null;

        switch ($status) {
            case true : 
                $type = 'success';
                $value = 'Aktif';
                break;
            case false : 
                $type = 'danger';
                $value = 'Tidak Aktif';
                break;
            default : 
                $type = 'danger';
                $value = 'Tidak Aktif';
                break;
        }

        return (object)[
            'type' => $type,
            'value' => $value
        ];
    }
}
