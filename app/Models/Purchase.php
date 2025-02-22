<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    protected $fillable = [
        'id',
        'pembeli',
        'acara_id',
        'tiket_id',
        'jumlah_tiket',
        'total_harga',
        'pembayaran',
        'status'
    ];

    public function event(): BelongsTo {
        return $this->belongsTo(Event::class, 'acara_id');
    }

    public function ticket(): BelongsTo {
        return $this->belongsTo(Ticket::class, 'tiket_id');
    }

    

}
