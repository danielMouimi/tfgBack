<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Oferta extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'nombre',
        'descuento',
        'fecha_inicio',
        'fecha_fin',
    ];
    public function usuario() {
        return $this->belongsTo(User::class);
    }

    public function tours() {
        return $this->belongsToMany(Tour::class, 'oferta_tours');
    }
}
