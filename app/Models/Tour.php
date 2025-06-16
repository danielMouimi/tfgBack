<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'duracion_total', 'descripcion', 'oferta_id'];
    public function reservas() {
        return $this->belongsToMany(Reserva::class, 'reserva_tours')->withPivot('precio_final', 'fecha_salida')->withTimestamps();
    }

    public function etapas() {
        return $this->hasMany(EtapaTour::class);
    }

    public function oferta() {
        return $this->belongsTo(Oferta::class);
    }

}
