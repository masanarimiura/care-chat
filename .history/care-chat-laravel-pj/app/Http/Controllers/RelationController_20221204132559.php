<?php

namespace App\Http\Controllers;

use App\Models\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Relation\RelationUpdateRequest;

class RelationController extends Controller
{
    // client_id と patient_id の重複がないか確認し、状況に応じて作成、更新
    public function update(RelationUpdateRequest $request)
    {
        $check = Relation::where('client_id',$request->client_id)
        ->where('patient_id',$request->patient_id)
        ->first();
        if ($check) {
            // 既存のrelation_type_idを更新
            $update = [
            'relation_type_id' => $request->relation_type_id,
            ];
            $item = Relation::where('id', $relation->id)->update($update);
            if ($item) {
                return response()->json([
                'message' => 'Updated successfully',
                ], 200);
            } else {
                return response()->json([
                'message' => 'Not found',
                ], 404);
            }

            return response()->json([
                'message' => 'Updated successfully',
            ], 200);
        } else if ($item == null) {
            // relation_type_idを作成
            $item = Relation::create($request->all());
            return response()->json([
                'data' => $item
            ], 201);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }

    // my-page.vueからの relation_type_id の保存
    public function store(RelationUpdateRequest $request)
    {
        $item = Relation::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }

    // my-page.vueからの relation_type_id の更新
    public function updates(RelationUpdateRequest $request, Relation $relation)
    {
        $update = [
            'relation_type_id' => $request->relation_type_id,
        ];
        $item = Relation::where('id', $relation->id)->update($update);
        if ($item) {
            return response()->json([
            'message' => 'Updated successfully',
            ], 200);
        } else {
            return response()->json([
            'message' => 'Not found',
            ], 404);
        }
    }
}
