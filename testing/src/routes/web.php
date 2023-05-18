<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PayController;

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
    return view('home', ['title' => 'Beranda']);
})->name('home');

Route::get('/payment', function () {
    return view('payment', ['title' => 'pembayaran']);
})->name('payment');

Route::get('/topup', function () {
    return view('topup', ['title' => 'Top Up']);
})->name('topup');

Route::get('/transfer', function () {
    return view('transfer', ['title' => 'Transfer']);
})->name('transfer');

Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'register_action'])->name('register.action');
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'login_action'])->name('login.action');
Route::get('password', [UserController::class, 'password'])->name('password');
Route::post('password', [UserController::class, 'password_action'])->name('password.action');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::get('home', [PayController::class, 'pay'])->name('pay');
Route::post('home', [PayController::class, 'pay_action'])->name('pay.action');
Route::get('guest_home', [PayController::class, 'guest_pay'])->name('guest.pay');
Route::post('guest_home', [PayController::class, 'guest_pay_action'])->name('guest.pay.action');

Route::get('index', [PostController::class, 'index'])->name('index');
Route::post('index', [PostController::class, 'create'])->name('posts.create');

Route::post('topup', [UserController::class, 'top_up_action'])->name('top.up.action');

Route::post('transfer', [UserController::class, 'transfer_action'])->name('transfer.action');
Route::post('guest_transfer', [UserController::class, 'guest_transfer_action'])->name('guest.transfer.action');

