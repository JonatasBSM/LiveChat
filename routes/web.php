<?php

use App\Http\Controllers\ProfileController;
use \App\Http\Controllers\PusherController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(\App\Http\Controllers\ChannelsController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/create', 'create');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('pusher')->group(function () {
    Route::post('/broadcast', [PusherController::class, 'broadcast']);
    Route::get('/listen', [PusherController::class, 'listen']);
});

require __DIR__.'/auth.php';
