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

    // チャットページでpatient_idから様々な情報を取得
    public function show(Request $request)
    {
        $item = Patient::where('id',$request->id)
        ->with('comme');
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
