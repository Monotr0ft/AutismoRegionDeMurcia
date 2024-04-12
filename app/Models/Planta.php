<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Planta extends Model
{
    use HasFactory;

    protected $connection = 'mysql-arba';

    public function stock(): HasMany
    {
        return $this->hasMany(StockPlanta::class, 'planta_id');
    }
    
}
