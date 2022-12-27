<?php

namespace App\Http\Controllers;

use App\Models\WorkerPatient;
use Illuminate\Http\Request;

class WorkerPatientController extends Controller
{

    // client_patientsテーブルの履歴にclient_idとpatient_idの同じ組み合わせが無いか確認。
    public function check(Request $request)
    {
        $item = ClientPatient::where('client_id',$request->client_id)
        ->where('patient_id',$request->patient_id)
        ->get();
        if ($item) {
            return response()->json([
                'data' => $item
            ], 200);
        } else if ($item == null) {
            return response()->json([
                'data' => null
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }
    public function store(Request $request)
    {
        $item = WorkerPatient::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }
}