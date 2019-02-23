<?php

namespace App\Http\Controllers;

use App\Appointments;
use App\Climbers;
use App\Locations;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AppointmentsController extends Controller
{

    /**
     * Store a new Appointment
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
                    'time' => 'required',
                    'day' => 'required',
                    'climber_id' => 'required',
                    'location_id' => 'required',
                ]
            );

            $appointment = new Appointments([
                'time' => $request->time,
                'day' => $request->day,
            ]);

            $climber = Climbers::find($request->climber_id);
            $location = Locations::find($request->location_id);

            $appointment->climber()->associate($climber);
            $appointment->location()->associate($location);

            $appointment->save();

            return JsonResponse::create(
                $appointment,
                JsonResponse::HTTP_CREATED
            );

        }catch (ValidationException $validationException){
            return JsonResponse::create(
                $validationException->errors(),
                $validationException->status
            );

        }catch (\Exception $exception){
            return JsonResponse::create(
                $exception->getMessage(),
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    /**
     * List all Appointments
     *
     * @return array
     */
    public function index()
    {
        return Appointments::all()->toArray();
    }


    /**
     * Show a specific Appointment
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            return Appointments::findOrFail($id);

        }catch (ModelNotFoundException $modelNotFoundException){
            return Response::create(
                null,
                Response::HTTP_NOT_FOUND
            );
        }
    }
}
