<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;
use App\Models\Room;
use App\Models\RoomType;

class HotelController extends Controller
{

    public function pay($hotelId)
    {
        $hotel = Hotel::with('images')->findOrFail($hotelId);
        return view('booking.create', compact('hotel'));
    }


    public function hotel()
    {
        $countries = Country::all();
        $hotels = Hotel::all();
        return view('hotel.hotel', compact('countries', 'hotels'));
    }

    public function search(Request $request)
    {
        $query = Hotel::query();

        if ($request->filled('country_id')) {
            $query->where('country_id', $request->country_id);
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->filled('stars')) {
            $query->whereIn('stars', $request->stars);
        }

        if ($request->has('no_stars')) {
            $query->orWhereNull('stars');
        }

        if ($request->sort_by === 'rating') {
            $query->orderByDesc('rating');
        } elseif ($request->sort_by === 'price') {
            $query->orderBy('price_per_night');
        }

        session([
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
        ]);

        $filteredHotels = $query->get();
        $countries = Country::all();

        return view('search-results', [
            'filteredHotels' => $filteredHotels,
            'countries' => $countries
        ]);
    }
}
