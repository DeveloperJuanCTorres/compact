<?php

use Illuminate\Support\Facades\Route;
use App\Exports\ProductsExport;
use App\Http\Controllers\IzipayController;
use Maatwebsite\Excel\Facades\Excel;

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
Route::get('/ofertas', [App\Http\Controllers\HomeController::class, 'ofertas'])->name('ofertas');
Route::get('/product/{product}', [App\Http\Controllers\HomeController::class, 'detail'])->name('product.detail');
Route::get('/buscar', [App\Http\Controllers\HomeController::class, 'buscar'])->name('buscar');
Route::get('/product/{product}', [App\Http\Controllers\HomeController::class, 'detail'])->name('product.detail');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/libro-reclamaciones', [App\Http\Controllers\HomeController::class, 'reclamaciones'])->name('libro-reclamaciones');

Route::post('add', [App\Http\Controllers\CartController::class, 'add'])->name('add');
Route::get('cart', [App\Http\Controllers\CartController::class, 'cart'])->name('cart');
Route::post('/cart/update', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::get('cart/clear', [App\Http\Controllers\CartController::class, 'clear'])->name('clear');
Route::post('cart/removeitem', [App\Http\Controllers\CartController::class, 'removeItem'])->name('removeitem');
Route::get('/checkout', [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout');

Route::post('/izipay', [IzipayController::class, 'izipay'])->name('izipay');
Route::post("result", [IzipayController::class, 'result'])->name("result");
Route::post('/ipn/izipay', [IzipayController::class, 'ipn'])->name('ipn.izipay');

Route::get('/export/products', function () {
        return Excel::download(new ProductsExport, 'products.xlsx');
    });

Route::get('/products/{product}/color/{color}/images', [App\Http\Controllers\HomeController::class, 'getColorImages']);


Route::post('/contact/send', [App\Http\Controllers\HomeController::class, 'correoContact'])->name('contact.send');
Route::post('/reclamo',[App\Http\Controllers\HomeController::class,'correoReclamo']);


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    
});
