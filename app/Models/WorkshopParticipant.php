<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkshopParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'workshop_id',
        'participant_id',
        'status'
    ];

    public function getStatusLabelAttribute()
    {
        $type = null;
        $value = null;

        switch ($this->status) {
            case 'contacted':
                $type = 'success';
                $value = 'Dihubungi';
                break;

            case 'waiting':
                $type = 'warning';
                $value = 'Menunggu';
                break;
            
            default:
                $type = 'danger';
                $value = 'Tidak Diketahui';
                break;
        }

        return (object)[
            'type' => $type,
            'value' => $value
        ];
    }
}
