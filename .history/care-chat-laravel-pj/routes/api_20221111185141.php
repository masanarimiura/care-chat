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

Route::apiResource('/v1/patient', PatientController::class)->only([
        'store'
]);

Route::apiResource('/v1/client-patient', ClientPatientController::class)->only([
        'store'
]);

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

Route::get('/v1/client', [ClientController::class, 'show']);
Route::get('/v1/worker', [WorkerController::class, 'show']);

Route::post('/v1/patient-search', [PatientController::class, 'show']);

Route::get('/v1/client-comment-search', [ClientCommentController::class, 'show']);
Route::get('/v1/worker-comment-search', [WorkerCommentController::class, 'show']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
});
