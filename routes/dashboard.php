<?php

use App\Http\Controllers\Dashboard\CategorieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::group([
    'middleware'=>['auth'],
    'as'=>'dashboard.', //name
    'prefix'=>'dashboard/'
],function(){
    Route::get('/',[DashboardController::class,'index']);
    Route::get('/categories/trash',[CategorieController::class,'trash'])
           ->name('categories.trash');
    Route::put('/categories/{category}/restore',[CategorieController::class, 'restore'])
           ->name('categories.restore');
    Route::delete('/categories/{category}/force-delete',[CategorieController::class, 'forceDelete'])
           ->name('categories.force-delete');
    Route::resource('categories',CategorieController::class);

});
