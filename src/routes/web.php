<?php

use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
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

Route::view('/thanks', 'auth.thanks');
Route::view('/done', 'done');
Route::view('/mypage','mypage')
    ->middleware('auth');


Route::get('/',[ShopController::class,'index']);
Route::get('/detail/{shop_id}',[ShopController::class,'detail']);
Route::get('/logout',[AuthController::class,'destroy'])
    ->middleware('auth');
