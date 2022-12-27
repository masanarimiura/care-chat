<?php

namespace App\Http\Controllers;

use App\Models\ClientPatient;
use App\Models\Patient;
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
    // ここでclients の id を使って 患者チャットpatientの履歴 idを取得。
    public function show(Request $request)
    {
        $item = ClientPatient::where('client_id',$request->client_id)-->get();
        // $item2 = Patient::where('id',$item->data->patient_id);
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
