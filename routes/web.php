<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\ProductsController;

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

Route::get('/', [HomeController::class,'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/dashboard2', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard2');

Route::get('products',[ProductsController::class,'index'])
        ->name('products.index');
Route::get('products/{product:slug}',[ProductsController::class,'show'])
        ->name('product.show');
Route::resource('/cart',CartController::class)->except(['destroy']);

Route::delete('cart-delete', [CartController::class, 'destroy'])
        ->name('cart.delete');
Route::get('checkout', [CheckoutController::class, 'create'])
        ->name('checkout');
Route::post('checkout', [CheckoutController::class, 'store']);
require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
