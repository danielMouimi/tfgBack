<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'fecha_reserva',
        'estado',
        'precio_total'
    ];
    public function users() {
        return $this->belongsTo(User::class);
    }

    public function tours() {
        return $this->belongsToMany(Tour::class, 'reserva_tours')->withPivot('precio_final', 'fecha_salida')->withTimestamps();
    }
}
