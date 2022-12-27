<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function store(Request $request)
    {
        $item = Worker::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }
}
