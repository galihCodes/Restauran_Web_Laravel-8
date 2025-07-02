<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ReportController;
// use App\Http\Middleware\Admin;
// use App\Http\Middleware\Kasir;
// use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
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


// 

Route::get('/', function () {
    return view('welcome');
})->name('login');

//Admin
Route::get('/editprofil/{User}', [UserController::class, 'editadmin'])->middleware('admin');
Route::resource('/restauran/users', UserController::class)->middleware('admin');
Route::post('/restauran/tambahstok', [MenuController::class, 'tambahstok'])->middleware('admin');
Route::post('/restauran/menu/{id}/tambahstok', [MenuController::class, 'tambahstok2'])->middleware('admin');
Route::put('/restauran/menu/{id}/tambahstok', [MenuController::class, 'prosesstok2'])->middleware('admin');
Route::get('/restauran/laporan', [ReportController::class, 'index'])->middleware('admin');
Route::get('/restauran/laporan/{id}/detail', [ReportController::class, 'detail'])->middleware('admin');
Route::post('/restauran/laporan/cetak', [ReportController::class, 'cetak'])->middleware('admin');

//auth
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('/restauran', [DashboardController::class, 'index'])->middleware('auth');
Route::resource('/restauran/menu', MenuController::class)->middleware('auth');
Route::resource('/restauran/table', TableController::class)->middleware('auth');

//kasir
Route::put('/restauran/menu/{Mennu}', [MenuController::class, 'update'])->middleware('kasir');
Route::get('/myprofil/{User}', [UserController::class, 'profil'])->middleware('kasir');
Route::post('/cart/{id}', [CartController::class, 'tambahcart'])->middleware('kasir');
Route::get('/restauran/orders/proses', [CartController::class, 'proses'])->middleware('kasir');
Route::get('/restauran/orders/batal', [CartController::class, 'batal'])->middleware('kasir');
Route::get('/restauran/orders/{id}/hapus', [CartController::class, 'hapus'])->middleware('kasir');
Route::post('/restauran/orders', [CartController::class, 'sistem'])->middleware('kasir');
Route::get('/restauran/orders', [OrderController::class, 'index'])->middleware('kasir');
Route::get('/restauran/orders/deliver', [OrderController::class, 'deliver'])->middleware('kasir');
Route::post('/restauran/orders/{id}', [OrderController::class, 'proses'])->middleware('kasir');
Route::post('/restauran/{id}/hidden', [OrderController::class, 'hidden'])->middleware('kasir');
Route::get('/restauran/orders/save', [OrderController::class, 'saveall'])->middleware('kasir');
Route::get('/restauran/pembayaran', [TransaksiController::class, 'index'])->middleware('kasir');
Route::post('/restauran/{id}/prosesbayar', [TransaksiController::class, 'bayar'])->middleware('kasir');
Route::post('/restauran/{id}/struk', [TransaksiController::class, 'struk'])->middleware('kasir');
Route::post('/restauran/{id}/struk2', [TransaksiController::class, 'struk2'])->middleware('kasir');

Route::post('/proses', [LoginController::class, 'auth']);
Route::get('/form', [LoginController::class, 'index'])->middleware('guest');

Route::get('/register', function () {
    return view('Home.register');
})->middleware('admin');
Route::post('/register', [RegisterController::class, 'store'])->middleware('admin');
