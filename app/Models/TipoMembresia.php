<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMembresia extends Model
{
    /** @use HasFactory<\Database\Factories\TipoMembresiaFactory> */
    use HasFactory;

    protected $fillable = ['nombre', 'meses', 'precio', 'beneficios'];
}
