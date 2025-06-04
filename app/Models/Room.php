<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_number',
        'room_types_id',
        'hotel_id',
        'status',
        'price'];

    public function type()
    {
        return $this->belongsTo(RoomType::class, 'room_types_id');
    }



    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
