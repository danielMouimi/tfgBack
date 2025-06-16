<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaTour extends Model
{
    use HasFactory;

    protected $fillable = [
      'oferta_id',
      'tour_id',
    ];
    public function oferta() {
        return $this->belongsTo(Oferta::class);
    }

    public function tour() {
        return $this->belongsTo(Tour::class);
    }
}
