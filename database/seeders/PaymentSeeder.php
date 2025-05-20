<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\User;
use App\Models\Room;
use App\Models\Service;
use Illuminate\Support\Carbon;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $rooms = Room::all();
        $services = Service::all();

        if ($users->isEmpty() || $rooms->isEmpty()) {
            $this->command->warn('Нужно сначала создать пользователей и комнаты (users, rooms).');
            return;
        }

        foreach (range(1, 10) as $i) {
            $checkIn = Carbon::now()->addDays(rand(1, 30));
            $checkOut = (clone $checkIn)->addDays(rand(1, 5));

            Payment::create([
                'user_id' => $users->random()->id,
                'room_id' => $rooms->random()->id,
                'services_id' => $services->isNotEmpty() ? $services->random()->id : null,
                'check_in_date' => $checkIn,
                'check_out_date' => $checkOut,
                'status' => collect(['Pending', 'Paid', 'Cancelled'])->random(),
                'price' => mt_rand(10000, 50000) / 100,
            ]);
        }
    }
}
