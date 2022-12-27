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
    // ここでpatientを使って patientsのidを取得。
    public function show(Request $request)
    {
        $item = Patient::where('name',$request->name)
        ->where('password',$request->password)
        ->first();
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
