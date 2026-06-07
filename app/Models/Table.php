<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Table extends Model
{
    protected $fillable = ['name', 'capacity'];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
