<?php

namespace App\Http\Controllers;

use App\Models\ShopType;
use Illuminate\Http\Request;

class ShopTypeController extends Controller
{
    // 事業所分類一覧の取得
    public function index()
    {
        $items = Shop::all();
        return response()->json([
            'data' => $items
        ], 200);
    }
}
