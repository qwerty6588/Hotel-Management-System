<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function showPaymentForm(Hotel $hotel)
    {
        return view('booking.payment', compact('hotel'));
    }

    public function processPayment(Request $request, Hotel $hotel)
    {
        // Здесь будет "оплата"
        $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
            'card_number' => 'required|digits:16',
            'card_name' => 'required|string|max:255',
            'expiry' => 'required',
            'cvv' => 'required|digits:3',
        ]);

        // Сохраняем бронирование (опционально)
        // Booking::create(...);

        return redirect()->route('home')->with('success', 'Бронирование успешно оплачено!');
    }


    public function create($hotelId)
    {
        $hotel = Hotel::findOrFail($hotelId);
        return view('booking.create', compact('hotel'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
        ]);

        $hotel = Hotel::findOrFail($request->hotel_id);
        $nights = \Carbon\Carbon::parse($request->check_in)->diffInDays($request->check_out);
        $price = $nights * $hotel->price_per_night;

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'hotel_id' => $hotel->id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'guests' => $request->guests,
            'total_price' => $price,
            'status' => 'paid' // имитация оплаты
        ]);

        return redirect()->route('booking.success', $booking->id);
    }

    public function success($id)
    {
        $booking = Booking::with('hotel')->findOrFail($id);
        return view('booking.success', compact('booking'));
    }
}
