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
    Route::resource('categories',CategorieController::class);
});
 