<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalleventa extends Model
{
    /** @use HasFactory<\Database\Factories\DetalleventaFactory> */
    use HasFactory;

    protected $fillable = ['venta_id', 'producto_id'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
