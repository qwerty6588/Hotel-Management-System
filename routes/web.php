<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;
use App\Models\City;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [App\Http\Controllers\MainController::class, 'index']);



Route::middleware(['auth'])->group(function () {
    Route::get('/booking/{hotel}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/success/{id}', [BookingController::class, 'success'])->name('booking.success');
    Route::get('/booking/{hotel}/payment', [BookingController::class, 'showPaymentForm'])->name('booking.payment');
    Route::post('/booking/{hotel}/pay', [BookingController::class, 'processPayment'])->name('booking.pay');

});



Route::get('/cities/{country_id}', function ($country_id) {
    return City::where('country_id', $country_id)
        ->orderBy('name')
        ->get(['id', 'name']);
});


Route::get('/hotel', [HotelController::class, 'hotel'])->name('hotel')->middleware('auth');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::get('/search', [HotelController::class, 'search'])->name('search-results');

Route::get('/api/cities/{country}', [CityController::class, 'getCities']);





Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
