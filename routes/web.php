<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Auth;
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


Route::get('/logout', [\App\Http\Controllers\Auth\LogoutController::class, 'logout']);



Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('rooms', RoomController::class);
    Route::resource('room-types', RoomTypeController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('bookings', BookingController::class);
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
