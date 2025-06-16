<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReservaTour extends Model
{
    use HasFactory;

    protected $table = 'reserva_tours';

    protected $fillable = [
        'reserva_id',
        'tour_id',
        'precio_final',
        'fecha_salida',
    ];
    public function reserva() {
        return $this->belongsTo(Reserva::class);
    }

    public function tour() {
        return $this->belongsTo(Tour::class);
    }
}
