<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ClientPatientController;
use App\Http\Controllers\WorkerPatientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ShopController;


// クライアントアカウント登録
Route::apiResource('/v1/client', ClientController::class)->only([
        'store'
]);

// ケアワーカーアカウント登録
Route::apiResource('/v1/worker', WorkerController::class)->only([
        'store'
]);

// firebaseのuidを使って、clientかworkerかを確認する
Route::get('/v1/client', [ClientController::class, 'show']);
Route::get('/v1/worker', [WorkerController::class, 'show']);

// 新しい患者チャット作成
Route::apiResource('/v1/patient', PatientController::class)->only([
        'store'
]);

// クライアントが患者チャットを「作成」or「参加」時に次から簡単に参加できるように履歴を残す。
Route::apiResource('/v1/client-patient', ClientPatientController::class)->only([
        'store'
]);

// ケアワーカーが患者チャットを「作成」or「参加」時に次から簡単に参加できるように履歴を残す。
Route::apiResource('/v1/worker-patient', WorkerPatientController::class)->only([
        'store'
]);

Route::apiResource('/v1/shop', ShopController::class)->only([
        'index','store'
]);

Route::apiResource('/v1/client-comment', ClientCommentController::class)->only([
        'store','update','destroy'
]);

Route::apiResource('/v1/worker-comment', WorkerCommentController::class)->only([
        'store','update','destroy'
]);


Route::post('/v1/patient-search', [PatientController::class, 'show']);

Route::get('/v1/client-comment-search', [ClientCommentController::class, 'show']);
Route::get('/v1/worker-comment-search', [WorkerCommentController::class, 'show']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
});
