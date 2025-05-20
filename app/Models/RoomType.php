<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $fillable = ['name', 'description'];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'room_types_id');
    }
}
