<?php

namespace App\Http\Controllers;

use App\Locations;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LocationsController extends Controller
{
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->validate(
                $request,
                [
                    'name' => 'required|max:50',
                    'city' => 'required|max:50',
                    'address'=>'required|max:50',
                ]
            );
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
        }catch (ValidationException $validationException){
            return JsonResponse::create(
                $validationException->getMessage(),
                $validationException->status
            );
        }catch (\Exception $exception){
            return JsonResponse::create(
                ['error' => 'an error occurred'],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    /**
     * List all Locations
     *
     * @return array
     */
    public function index()
    {
        return Locations::all()->toArray();
    }

        /**
     * Show a specific Location
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            return Locations::findOrFail($id);

        }catch (ModelNotFoundException $modelNotFoundException){
            return Response::create(
                null,
                Response::HTTP_NOT_FOUND
            );
        }
    }
}
