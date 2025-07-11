<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Hotel;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
            'cvv' => 'required|digits:3',
        ]);

        $nights = \Carbon\Carbon::parse($request->check_in)->diffInDays($request->check_out);
        $price = $nights * $hotel->price_per_night;

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'hotel_id' => $hotel->id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'guests' => $request->guests,
            'total_price' => $price,
            'status' => 'paid',
        ]);

        return redirect()->route('booking.success', $booking->id);
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
            'status' => 'paid'
        ]);

        return redirect()->route('booking.success', $booking->id);
    }




    public function showGuestForm(Hotel $hotel)
    {
        return view('booking.guest-details', compact('hotel'));
    }

    public function submitGuestForm(Request $request, Hotel $hotel)
    {
        $data = $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'guests' => 'required|integer',
            'children' => 'nullable|integer',
            'room_type' => 'required|string',
            'special_requests' => 'nullable|string',
            'passport' => 'nullable|string',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
        ]);

        session(['booking_data' => $data]);

        return redirect()->route('booking.create', $hotel->id);

    }
    public function success($id)
    {
        $booking = Booking::with('hotel')->findOrFail($id);
        return view('booking.success', compact('booking'));
    }

    public function downloadInvoice($id)
    {
        $booking = Booking::with('hotel', 'user')->findOrFail($id);

        $pdf = Pdf::loadView('booking.invoice', compact('booking'));
        return $pdf->download("booking_invoice_{$booking->id}.pdf");
    }
}
