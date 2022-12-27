<?php

namespace App\Http\Controllers;

use App\Models\Relation;
use Illuminate\Http\Request;

class RelationController extends Controller
{


    
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
