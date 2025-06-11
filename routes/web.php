<?php

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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
Route::get('/product/{product}', [App\Http\Controllers\HomeController::class, 'detail'])->name('product.detail');
Route::get('/buscar', [App\Http\Controllers\HomeController::class, 'buscar'])->name('buscar');
Route::get('/product/{product}', [App\Http\Controllers\HomeController::class, 'detail'])->name('product.detail');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/libro-reclamaciones', [App\Http\Controllers\HomeController::class, 'reclamaciones'])->name('libro-reclamaciones');

Route::post('add', [App\Http\Controllers\CartController::class, 'add'])->name('add');
Route::get('cart', [App\Http\Controllers\CartController::class, 'cart'])->name('cart');
Route::get('cart/clear', [App\Http\Controllers\CartController::class, 'clear'])->name('clear');
Route::post('cart/removeitem', [App\Http\Controllers\CartController::class, 'removeItem'])->name('removeitem');
Route::get('/checkout', [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
