<?php

namespace App\Http\Controllers;

use App\Models\Relation;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    // client_id と patient_id の同じ組み合わせがないか確認
    public function check(Request $request)
    {
        $item = Worker::where('client_id',$request->client_id)
        ->where('patient_id',$request->client_id)
        ->first();
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

    // my-page.vueからの relation_type_id の保存
    public function store(Request $request)
    {
        $item = Relation::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }

    public function update(Request $request, Relation $relation)
    {
        //
    }
}
