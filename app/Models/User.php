<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function apartado(): HasOne
    {
        return $this->hasOne(Apartado::class, 'id_user');
    }

    public function esJefe(): bool
    {
        return $this->is_boss;
    }

    public function esAdministrador(): bool
    {
        return $this->apartado && $this->apartado->administrador;
    }

    public function esPropietario($modelo, $id = "user_id"): bool
    {
        return $this->id === $modelo->$id;
    }

    public function puedeGestionarTodo(): bool
    {
        return $this->esJefe() || $this->esAdministrador();
    }

    public function puedeGestionarAsociaciones(): bool
    {
        return $this->apartado && $this->apartado->asociaciones;
    }

    public function puedeGestionarNoticias(): bool
    {
        return $this->apartado && $this->apartado->noticias;
    }

    public function puedeGestionarPaginas(): bool
    {
        return $this->apartado && $this->apartado->paginas;
    }

    public function puedeGestionarRecursos(): bool
    {
        return $this->apartado && $this->apartado->recursos;
    }

}
