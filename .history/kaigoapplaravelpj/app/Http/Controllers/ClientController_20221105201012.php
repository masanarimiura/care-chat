<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function store(Request $request)
    {
        public function store(Request $request)
    {
        $item = User::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }
    }
}
