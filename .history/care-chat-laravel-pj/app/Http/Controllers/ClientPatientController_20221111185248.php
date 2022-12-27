<?php

namespace App\Http\Controllers;

use App\Models\ClientPatient;
use Illuminate\Http\Request;

class ClientPatientController extends Controller
{
    public function store(Request $request)
    {
        $item = ClientPatient::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }
}
