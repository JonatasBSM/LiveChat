<?php

use App\Http\Controllers\LiveChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LiveChatController::class, 'index'])->middleware('auth');