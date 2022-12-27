<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function store(Request $request)
    {
        $item = Patient::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }

    public function show(Patient $patient)
    {
        $item = Show::where([
            ['name',$patient->name],
            ['password', $patient->name],
            ])->first();
        if ($item) {
            return response()->json([
                'data' => $item
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }
}
