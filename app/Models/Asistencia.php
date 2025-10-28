<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    /** @use HasFactory<\Database\Factories\AsistenciaFactory> */
    use HasFactory;

    protected $fillable = ['fecha', 'cliente_id', 'user_id'];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
