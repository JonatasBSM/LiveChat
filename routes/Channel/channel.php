<?php

use App\Http\Controllers\ChannelsController;
use Illuminate\Support\Facades\Route;

Route::resource('channels', ChannelsController::class);