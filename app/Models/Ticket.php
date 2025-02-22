<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    protected $fillable = [
      'acara_id',
      'tiket',
      'harga_tiket',
      'max_kapasitas',
      'status'
    ];

    public function event() : BelongsTo {
      return $this->belongsTo(Event::class ,'acara_id');
    }

    public function purchase() : HasMany {
      return $this->hasMany(Purchase::class);
    }
}
