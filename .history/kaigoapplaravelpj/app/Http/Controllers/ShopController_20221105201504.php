<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $items = Tweet::with('user','likes')->get();
        return response()->json([
            'data' => $items
        ], 200);
    }

    public function store(Request $request)
    {
        //
    }
}
