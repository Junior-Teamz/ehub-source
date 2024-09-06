<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'url_thumbnail',
        'title',
        'slug',
        'content',
        'status',
        'viewer'
    ];

    public function hasTags()
    {
        return $this->belongsToMany(Tag::class, 'news_tags', 'news_id', 'tag_id');
    }

    public function hasUser() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function getStatusLabelAttribute() 
    {
        $status = $this->status;

        $type = null;
        $value = null;

        switch ($status) {
            case 'unpublish' : 
                $type = 'warning';
                $value = 'Draft';
                break;
            case 'ready' : 
                $type = 'info';
                $value = 'Menunggu validasi dari pusat informasi!';
                break; 
            case 'publish' : 
                $type = 'success';
                $value = 'Publish';
                break;
            case 'inactive' : 
                $type = 'danger';
                $value = 'Tidak Aktif';
                break;
            default : 
                $type = 'warning';
                $value = 'Draft';
                break;
        }

        return (object)[
            'type' => $type,
            'value' => $value
        ];
    }
}
