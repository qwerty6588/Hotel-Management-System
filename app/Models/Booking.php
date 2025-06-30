<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Booking.php
class Booking extends Model
{
    protected $fillable = [
        'user_id', 'hotel_id', 'check_in', 'check_out', 'guests', 'total_price', 'status'
    ];

    public function hotel() {
        return $this->belongsTo(Hotel::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

