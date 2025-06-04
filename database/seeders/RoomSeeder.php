<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run()
    {
        Room::create([
            'room_number' => 101,
            'hotel_id' => 1,
            'price' => 50,
            'room_type_id' => 1,
            'city_id' => 1,
            'status' => 'Available',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

