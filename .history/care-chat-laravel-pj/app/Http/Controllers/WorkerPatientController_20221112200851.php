<?php

namespace App\Http\Controllers;

use App\Models\WorkerPatient;
use Illuminate\Http\Request;

class WorkerPatientController extends Controller
{

    
    public function store(Request $request)
    {
        $item = WorkerPatient::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }
}