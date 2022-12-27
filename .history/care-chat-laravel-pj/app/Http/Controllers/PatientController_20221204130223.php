<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Patient\PatientStoreRequest;

class PatientController extends Controller
{
    // チャットの新規作成
    public function store(PatientStoreRequest $request)
    {
        $item = Patient::create($request->all());
        return response()->json([
            'data' => $item->id
        ], 201);
    }

    // チャットページでpatient_idから名前とpasswordを取得
    public function show(Patient $patient)
    {
        $item = Patient::find($patient)->first();
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
