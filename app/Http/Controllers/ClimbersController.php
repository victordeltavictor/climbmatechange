<?php

namespace App\Http\Controllers;

use App\Climbers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClimbersController extends Controller
{
    public function store(Request $request)
    {
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
    }


    public function index()
    {
        return Climbers::all();
    }
}
