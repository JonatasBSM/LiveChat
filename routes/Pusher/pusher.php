<?php

use App\Http\Controllers\PusherController;
use Illuminate\Support\Facades\Route;


Route::prefix('pusher')->group(function () {
    Route::post('/broadcast', [PusherController::class, 'broadcast']);
    Route::post('/broadcast/new-channel', [PusherController::class, 'newBroadcast']);
    Route::get('/listen', [PusherController::class, 'listen']);
});