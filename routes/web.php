<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/monthly_payments', [App\Http\Controllers\PaymentsController::class, 'monthly_payments'])->name('month_data');
Route::post('/monthly_payments_i', [App\Http\Controllers\PaymentsController::class, 'user_import'])->name('user_i');
Route::get('/payment_register', [App\Http\Controllers\PaymentsController::class, 'payment_view'])->name('pay_view');
Route::post('/send_payment_data', [App\Http\Controllers\PaymentsController::class, 'payment_create'])->name('send_payment_data');
Route::post('/send_payment_data_annual', [App\Http\Controllers\PaymentsController::class, 'annual_payment_create'])->name('send_annual_payment_data');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
