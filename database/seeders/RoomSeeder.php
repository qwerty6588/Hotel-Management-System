<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::insert([
            ['room_number' => '101', 'room_types_id' => 1, 'status' => 'Available', 'price' => 50.00],
            ['room_number' => '102', 'room_types_id' => 2, 'status' => 'Available', 'price' => 75.00],
            ['room_number' => '201', 'room_types_id' => 3, 'status' => 'Booked', 'price' => 120.00],
        ]);
    }
}
