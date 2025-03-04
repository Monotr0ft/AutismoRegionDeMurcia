<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Apartado extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'administrador',
        'asociaciones',
        'noticias',
        'paginas',
        'recursos',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
