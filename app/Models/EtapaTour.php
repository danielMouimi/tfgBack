<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EtapaTour extends Model
{
    use HasFactory;

    protected $fillable = ['tour_id', 'destino_id', 'dias', 'hotel'];
    public function tour() {
        return $this->belongsTo(Tour::class);
    }

    public function destino() {
        return $this->belongsTo(Destino::class);
    }
}
