<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DireccionArba extends Model
{
    use HasFactory;

    protected $connection = 'mysql-arba';

    protected $table = 'direcciones_arba';

    public function socio(): HasOne
    {
        return $this->hasOne(Socio::class, 'direccion');
    }
}
