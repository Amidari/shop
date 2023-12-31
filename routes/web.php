<?php

use Illuminate\Support\Facades\Route;

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


Route::group(['prefix' => 'admin'], function (){
    Route::get('/', App\Http\Controllers\Main\IndexController::class)->name('main.index');
    Route::resources([
        'category' => \App\Http\Controllers\Category\CategoryController::class,
        'teg' => \App\Http\Controllers\Teg\TegController::class,
        'color' => \App\Http\Controllers\Color\ColorController::class,
        'user' => \App\Http\Controllers\User\UserController::class,
        'product' => \App\Http\Controllers\Product\ProductController::class,
        'group' => \App\Http\Controllers\Group\GroupController::class,
    ]);
});
Route::get('/',fn()=>view('layouts.app'));
Route::get('{page}',fn()=>view('layouts.app'))->where('pade', '.*');


