<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoreController;

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
// route::view('/','login');
// Route::post('/login', [HomeController::class,'login']);

Route::middleware(['is-login'])->group(function () {

    Route::get('/index', [HomeController::class,'index']);
    Route::get('/store/active-stores', [StoreController::class,'active']);
    Route::get('/store/empty-stores', [StoreController::class,'empty']);
    Route::post('/store/renew/{id}', [HomeController::class,'renew']);
    Route::get('/store/{store}/edit', [StoreController::class,'edit']);
    Route::post('/store/save', [StoreController::class,'save']);
    Route::post('/store/{store}', [StoreController::class,'update']);
    Route::post('/store', [StoreController::class,'store']);
    Route::get('/store/create', [StoreController::class,'create']);
    Route::delete('/store/{store}', [StoreController::class,'destroy']);


    Route::get('/logout', [HomeController::class,'logout'])->name('logout');


});



Route::get('/', [HomeController::class,'loginShow'])->name('login');
Route::post('/login', [HomeController::class,'login']);
Route::get('/redirect', [HomeController::class,'redirectToProvider']);
Route::get('/callback', [HomeController::class,'handleProviderCallback']);
