<?php

namespace App\Http\Controllers;

use App\Locations;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LocationsController extends Controller
{
    public function store(Request $request)
    {
        $location = New Locations([
            'name'=> $request->name,
            'city'=> $request->city,
            'address'=> $request->address,
            'geolocation'=> $request->geolocation,
        ]);

        $location->save();

        return JsonResponse::create(
            $location,
            JsonResponse::HTTP_CREATED
        );
    }

    public function index()
    {
        return Locations::all();
    }
}
