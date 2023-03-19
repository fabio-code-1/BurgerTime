<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WhatsAppController;

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

Route::get('/', [ProductController::class, 'index']);

Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add')->middleware('auth');
Route::get('/cart/delete', [CartController::class, 'delete'])->name('cart.delete');
Route::delete('/cart/{id}', [CartController::class, 'deleteOne'])->name('cart.deleteOne');

Route::get('/dashboard', [CartController::class, 'dashboard'])->name('dashboard');

Route::get('/whatsapp/send-message', [WhatsAppController::class, 'sendWhatsAppMessage'])->name('whatsapp.send');
