<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function store(Request $request)
    {
        //
    }

    public function show(Patient $patient)
    {
        $item = Patient::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }
}
