<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{
    /** @use HasFactory<\Database\Factories\MembresiaFactory> */
    use HasFactory;

    const ESTADO_ACTIVO = 'activo';
    const ESTADO_PENDIENTE = 'pendiente';
    const ESTADO_CANCELADO = 'cancelado';
    
    const ESTADOS = [
        self::ESTADO_ACTIVO => 'Activo',
        self::ESTADO_PENDIENTE => 'Pendiente',
        self::ESTADO_CANCELADO => 'Cancelado',
    ];

    protected $fillable =  ['fecha_inicio', 'fecha_fin', 'estado', 'precio_pagado', 'tipomembresia_id', 'cliente_id'];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function tipomembresia(){
        return $this->belongsTo(TipoMembresia::class);
    }

    public function pagos(){
        return $this->hasMany(Pago::class);
    }

    public function getSaldoAttribute()
    {
        return $this->pagos()->sum('monto');
    }

    public function getSaldoPendienteAttribute(): float
    {
        return $this->precio - $this->saldo;
    }
}
