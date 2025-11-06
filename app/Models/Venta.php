<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    /** @use HasFactory<\Database\Factories\VentaFactory> */
    use HasFactory;

    protected $fillable = ['razon_social', 'nit', 'total', 'cliente_id', 'user_id'];

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }
}
