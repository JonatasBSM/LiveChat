<?php

use App\Http\Controllers\LiveChatController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    require __DIR__.'/Home/home.php';
    require __DIR__.'/Channel/channel.php';
    require __DIR__.'/User/user.php';
    require __DIR__.'/Pusher/pusher.php';
});

require __DIR__.'/auth.php';

