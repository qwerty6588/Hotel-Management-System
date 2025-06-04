<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getCities($countryId)
    {
        $cities = City::where('country_id', $countryId)->get(['id', 'name']);
        return response()->json($cities);
    }
}
