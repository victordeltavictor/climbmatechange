<?php

namespace App\Http\Controllers;

use App\Climbers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ClimbersController extends Controller
{
    public function store(Request $request)
    {
        try {
            $this->validate(
                $request,
                [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'grade' => 'required',
                ]
            );

            $climber = new Climbers([
                'account_id' => 0,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'grade' => $request->grade,
            ]);

            $climber->save();

            return JsonResponse::create(
                $climber,
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


    public function index()
    {
        return Climbers::all();
    }
}
