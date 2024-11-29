<?php

use App\Http\Controllers\Dashboard\CategorieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use  App\Http\Controllers\Dashboard\StoresController;

Route::group([
    'middleware'=>['auth'],
    'as'=>'dashboard.', //name
    'prefix'=>'dashboard/'
],function(){
    Route::get('/',[DashboardController::class,'index']);
    //category routes
    Route::get('/categories/trash',[CategorieController::class,'trash'])
           ->name('categories.trash');
    Route::put('/categories/{category}/restore',[CategorieController::class, 'restore'])
           ->name('categories.restore');
    Route::delete('/categories/{category}/force-delete',[CategorieController::class, 'forceDelete'])
           ->name('categories.force-delete');
    Route::resource('categories',CategorieController::class);
    //stor routes
    Route::get('/stores/trash',[StoresController::class,'trash'])
           ->name('stores.trash');
    Route::put('/stores/{store}/restore',[StoresController::class, 'restore'])
           ->name('stores.restore');
    Route::delete('/stores/{store}/force-delete',[StoresController::class, 'forceDelete'])
           ->name('stores.force-delete');
    Route::resource('stores',StoresController::class);


});
