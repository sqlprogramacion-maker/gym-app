<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{
    /** @use HasFactory<\Database\Factories\MembresiaFactory> */
    use HasFactory;

    protected $fillable =  ['fecha_inicio', 'fecha_fin', 'estado', 'precio_pagado', 'tipomembresia_id', 'cliente_id'];
}
