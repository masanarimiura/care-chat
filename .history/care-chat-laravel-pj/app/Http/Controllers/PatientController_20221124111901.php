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

    // チャットページでpatient_idから名前とpasswordを取得
    public function show(Patient $request)
    {
        $item = Patient::where('id',$request->id)
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
    public function show(Rest $rest)
    {
        $item = Rest::find($rest);
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
    // ここでpatientのnameとpasswordを使って patientsのidを取得。
    public function search(Request $request)
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
