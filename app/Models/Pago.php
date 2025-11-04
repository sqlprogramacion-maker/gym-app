<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    /** @use HasFactory<\Database\Factories\PagoFactory> */
    use HasFactory;

    protected $fillable = ['fecha', 'monto', 'membresia_id', 'user_id'];

    public function membresia(){
        return $this->belongsTo(Membresia::class);
    }
}
