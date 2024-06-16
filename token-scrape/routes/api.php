<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\accesstokenController;
use App\Http\Controllers\LineNotifyController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/accesstoken', [accesstokenController::class, 'createAccessToken']);
Route::get('/line-notify/token', [LineNotifyController::class, 'generateToken']);

Route::get('/line-notify', [LineNotifyController::class, 'index']);
Route::get('/line-notify/callback', [LineNotifyController::class, 'callback']);