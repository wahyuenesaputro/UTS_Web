<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_booking',
        'user_id',
        'field_id',
        'tanggal',
        'jam_mulai',
        'durasi',
        'jam_selesai',
        'total_harga',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'total_harga' => 'decimal:2',
        'durasi' => 'integer',
    ];

    /**
     * Booking belongs to User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Booking belongs to Field.
     */
    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    /**
     * Booking has one Payment.
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
