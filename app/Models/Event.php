<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Event extends Model
{
    protected $fillable = [
        'id',
        'acara',
        'deskripsi',
        'tanggal_acara',
        'lokasi',
        'max_kapasitas'
    ];

    public function ticket() : HasMany {
        return $this->hasMany(Ticket::class);
    }

    public function purchases() : HasManyThrough {
        return $this->hasManyThrough(Purchase::class, Ticket::class);
    }
}
