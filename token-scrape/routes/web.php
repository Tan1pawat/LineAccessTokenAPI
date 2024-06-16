<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LineNotifyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});


Route::get('/line-notify', [LineNotifyController::class, 'index']);
Route::get('/line-notify/callback', [LineNotifyController::class, 'callback']);