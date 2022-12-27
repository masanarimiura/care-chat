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
        'show' , 'store'
]);
// 対象のtweetに対するcommentの投稿 store ,対象のコメントの削除

Route::get('/v1/user', [UserController::class, 'show']);
// セッション更新時ログイン状態保持時 user_id を取得する show
Route::get('/v1/tweet/target', [TweetController::class, 'show']);
// 対象tweetの表示 show
Route::get('/v1/comment', [CommentController::class, 'show']);
// 対象のtweetに対するcommentの表示


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
