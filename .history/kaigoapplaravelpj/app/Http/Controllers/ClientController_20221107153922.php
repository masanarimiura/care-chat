<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request,Student::$rules);
        $item = Client::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }
}
