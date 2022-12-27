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
        $item = Shop::where('name',$request->name)
        ->where('shop_type_id',$request->shop_type_id)
        ->where('email',$request->shop_type_id)
        ->first();
        $item = Shop::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }
}
