<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lapangan',
        'jenis_lapangan',
        'harga_per_jam',
        'deskripsi',
        'gambar',
        'status',
    ];

    protected $casts = [
        'harga_per_jam' => 'decimal:2',
    ];

    /**
     * Field has many bookings.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Field has many reviews.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
