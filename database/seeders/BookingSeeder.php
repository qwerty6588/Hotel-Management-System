<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Booking;
use App\Models\User;

class BookingSeeder extends Seeder
{
    public function run(): void
    {

        $users = User::all();
        if ($users->isEmpty()) {
            $this->command->warn('Нет пользователей. Сначала запусти UserSeeder.');
            return;
        }

        foreach (range(1, 10) as $i) {
            Booking::create([
                'booking_id' => strtoupper(Str::random(10)),
                'user_id' => $users->random()->id,
                'price' => mt_rand(5000, 20000) / 100,
                'payment_method' => collect(['card', 'cash', 'paypal'])->random(),
            ]);
        }
    }
}
