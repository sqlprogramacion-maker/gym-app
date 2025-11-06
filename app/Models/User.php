<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const ROL_ADMINISTRADOR = 'administrador';
    const ROL_RECEPCIONISTA = 'recepcionista';

    const ESTADOS = [
        self::ROL_ADMINISTRADOR => 'Administrador',
        self::ROL_RECEPCIONISTA => 'Recepcionista',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdministrador(): bool
    {
        return $this->rol === 'administrador';
    }

    public function hasRole(string $role): bool
    {
        return $this->rol === $role;
    }

    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->rol, $roles);
    }
}
