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
use App\Http\Controllers\RelationController;


// クライアントアカウント登録、更新
Route::apiResource('/v1/client', ClientController::class)->only([
        'store','update'
]);

// ケアワーカーアカウント登録、更新
Route::apiResource('/v1/worker', WorkerController::class)->only([
        'store','update'
]);

// firebaseのuidを使って、clientかworkerかを確認する
Route::get('/v1/client-check', [ClientController::class, 'check']);
Route::get('/v1/worker-check', [WorkerController::class, 'check']);

// clients or workerのidを使って情報を取得。
Route::get('/v1/client-search', [ClientController::class, 'show']);
Route::get('/v1/worker-search', [WorkerController::class, 'show']);

// 新しい患者チャット patientsテーブルに作成
Route::apiResource('/v1/patient', PatientController::class)->only([
        'store'
]);

// patientのnameとpasswordを使って patientsのidを取得。
Route::get('/v1/patient-search', [PatientController::class, 'search']);

// patientsのidを使って情報を取得。
Route::get('/v1/patient-show', [PatientController::class, 'show']);

// クライアントが患者チャットを「作成」or「参加」時に次から簡単に参加できるように履歴を残す。
Route::apiResource('/v1/client-patient', ClientPatientController::class)->only([
        'store'
]);

// ケアワーカーが患者チャットを「作成」or「参加」時に次から簡単に参加できるように履歴を残す。
Route::apiResource('/v1/worker-patient', WorkerPatientController::class)->only([
        'store'
]);

// client_patientテーブルの履歴に同じ client_id と patient_id の組み合わせが無いか確認。
Route::get('/v1/client-patient-check', [ClientPatientController::class, 'check']);
Route::get('/v1/worker-patient-check', [WorkerPatientController::class, 'check']);

// join時に患者チャットの履歴取得
Route::get('/v1/client-patient-search', [ClientPatientController::class, 'show']);
Route::get('/v1/worker-patient-search', [WorkerPatientController::class, 'show']);

// コメントとそれに付随する情報の取得。
Route::get('/v1/comment-search', [CommentController::class, 'show']);

// コメントの投稿、更新、削除
Route::apiResource('/v1/comment', CommentController::class)->only([
        'store','update','destroy'
]);

// my-page.vueからの relation_type_id の保存
Route::apiResource('/v1/relation', RelationController::class)->only([
        'store','update'
]);

// relation
Route::get('/v1/relation-check', [RelationController::class, 'check']);


Route::apiResource('/v1/shop', ShopController::class)->only([
        'index','store'
]);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
});
