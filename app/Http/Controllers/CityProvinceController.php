<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class CityProvinceController extends Controller
{
    public function index()
    {
        return response()->json([
            'provinces' => Province::all()
        ])->setStatusCode(200);
    }

    public function find_cities(Province $province)
    {
        return response()->json([
            'cities' => $province->cities
        ])->setStatusCode(200);
    }
}
