<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use  App\Http\Controllers\Dashboard\StoresController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Middleware\CheckUserType;

Route::group([
    'middleware' => ['auth','user.type:admin,super-admin'],
    'as' => 'dashboard.', //name
    'prefix' => 'dashboard/'
], function () {
    Route::get('/', [DashboardController::class, 'index']);
    //category routes
    Route::get('/categories/trash', [CategoriesController::class, 'trash'])
        ->name('categories.trash');
    Route::put('/categories/{category}/restore', [CategoriesController::class, 'restore'])
        ->name('categories.restore');
    Route::delete('/categories/{category}/force-delete', [CategoriesController::class, 'forceDelete'])
        ->name('categories.force-delete');
    Route::resource('categories', CategoriesController::class);
    //store routes
    Route::get('/stores/trash', [StoresController::class, 'trash'])
        ->name('stores.trash');
    Route::put('/stores/{store}/restore', [StoresController::class, 'restore'])
        ->name('stores.restore');
    Route::delete('/stores/{store}/force-delete', [StoresController::class, 'forceDelete'])
        ->name('stores.force-delete');
    Route::resource('stores', StoresController::class);
    //product routes
    Route::get('/products/trash', [ProductsController::class, 'trash'])
        ->name('products.trash');
    Route::put('/products/{store}/restore', [ProductsController::class, 'restore'])
        ->name('products.restore');
    Route::delete('/products/{store}/force-delete', [ProductsController::class, 'forceDelete'])
        ->name('products.force-delete');
    Route::resource('products', ProductsController::class);
    // profile routes
    Route::get('/profile/edit',[ProfileController::class, 'edit'])
           ->name('profile.edit');
    Route::patch('/profile/update',[ProfileController::class, 'update'])
    ->name('profile.update');
});
