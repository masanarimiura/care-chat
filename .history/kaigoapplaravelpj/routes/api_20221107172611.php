<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\CommentController;


Route::apiResource('/v1/client', ClientController::class)->only([
        'store'
]);

Route::apiResource('/v1/worker', WorkerController::class)->only([
        'store'
]);

Route::apiResource('/v1/shop', ShopController::class)->only([
        'index','store'
]);

Route::apiResource('/v1/patient', PatientController::class)->only([
        'store'
]);

Route::apiResource('/v1/comment', CommentController::class)->only([
        'show','store','update','destroy'
]);

Route::get('/v1/tweet/target', [TweetController::class, 'show']);
// 対象tweetの表示 show

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
