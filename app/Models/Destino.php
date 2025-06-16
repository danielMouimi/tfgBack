<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Destino extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'fotos', 'pais'];
    public function etapas() {
        return $this->hasMany(EtapaTour::class);
    }
}
