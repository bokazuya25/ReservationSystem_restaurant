<?php

use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Reviews;
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

Route::get('/',[ShopController::class,'index']);
Route::get('/search',[ShopController::class,'search'])
    ->name('search');

Route::get('/detail/{shop_id}',[ShopController::class,'detail']);
Route::get('/logout',[AuthController::class,'destroy'])
    ->middleware('auth');

Route::post('/favorite/store/{shop}',[FavoriteController::class,'store'])
    ->name('favorite');
Route::delete('/favorite/destroy/{shop}',[FavoriteController::class,'destroy'])
    ->name('unfavorite');

Route::get('/mypage',[AuthController::class,'index'])
    ->middleware('auth','verified');

Route::post('/reservation/store/{shop}',[ReservationController::class,'store'])
    ->name('reservation');
Route::delete('/reservation/destroy/{reservation}',[ReservationController::class,'destroy'])
    ->name('reservation.destroy');
Route::get('/reservation/edit/{reservation}',[ReservationController::class,'edit'])
    ->name('reservation.edit');
Route::post('/reservation/update/{reservation}',[ReservationController::class,'update'])
    ->name('reservation.update');

Route::get('/review/{reservation}',[ReviewController::class,'index'])
    ->name('review');
Route::post('/review/store/{reservation}',[ReviewController::class,'store'])
    ->name('review.store');