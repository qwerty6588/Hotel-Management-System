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
    public function home()
    {
        $countries = Country::all();
        return view('home.home', compact('countries', ));
    }

    public function search(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
        ]);

        $filteredHotels = Hotel::where('country_id', $request->country_id)
            ->where('city_id', $request->city_id)
            ->get();

        return view('search-results', compact('filteredHotels'));
    }

}
