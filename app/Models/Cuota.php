<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cuota extends Model
{
    use HasFactory;

    protected $connection = 'mysql-arba';

    public function socio(): BelongsTo
    {
        return $this->belongsTo(Socio::class);
    }

}
