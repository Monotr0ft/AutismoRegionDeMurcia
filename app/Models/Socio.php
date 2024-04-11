<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Socio extends Model
{

    use HasFactory;

    protected $connection = 'mysql-arba';

    public function arbaUser(): BelongsTo
    {
        return $this->belongsTo(ArbaUser::class, 'user_id');
    }

    public function direccion(): BelongsTo
    {
        return $this->belongsTo(DireccionArba::class, 'direccion');
    }

    public function cuota(): HasMany
    {
        return $this->hasMany(Cuota::class);
    }
    
}
