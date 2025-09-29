<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UsersTableSeeder::class]);
        $this->call(CountriesSeeder::class);
        $this->call(CitiesSeeder::class);
        $this->call(HotelsTableSeeder::class);
        $this->call(RoomTypeSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(BookingSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(PaymentSeeder::class);
    }
}
