<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lugar extends Model
{
    use HasFactory;

    protected $connection = 'mysql-arba';

    protected $table = 'lugares';

    public function stock(): HasMany
    {
        return $this->hasMany(StockPlanta::class, 'lugar_id');
    }

}
