<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    /** @use HasFactory<\Database\Factories\MantenimientoFactory> */
    use HasFactory;

    protected $fillable = ['costo', 'fecha', 'tipo_mantenimiento', 'descripcion', 'equipo_id'];

    public function equipo(){
        return $this->belongsTo(Equipo::class);
    }
}
