<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'field_id',
        'rating',
        'komentar',
    ];

    /**
     * Review belongs to User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Review belongs to Field.
     */
    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
