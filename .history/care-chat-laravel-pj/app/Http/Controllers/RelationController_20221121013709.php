<?php

namespace App\Http\Controllers;

use App\Models\Relation;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    // 
    public function check(Request $request)
    {
        $item = Worker::where('uid',$request->uid)->first();
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
