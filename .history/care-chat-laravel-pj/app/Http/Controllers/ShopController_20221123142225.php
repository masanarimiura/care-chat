<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $items = Shop::all();
        return response()->json([
            'data' => $items
        ], 200);
    }

    public function store(Request $request)
    {
        $item = Shop::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }

    public function search(Request $request)
    {
        $item = Shop::where('patient_id',$request->patient_id)
        ->with('client.relations.relation_type','worker.role')
        ->get();
        $item = Shop::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }
}
