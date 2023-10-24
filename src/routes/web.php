<?php

use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
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

Route::get('/', [ShopController::class, 'index']);
Route::get('/search', [ShopController::class, 'search'])->name('search');

Route::get('/detail/{shop_id}', [ShopController::class, 'detail']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/logout', [AuthController::class, 'destroy']);

    Route::post('/favorite/store/{shop}', [FavoriteController::class, 'store'])->name('favorite');
    Route::delete('/favorite/destroy/{shop}', [FavoriteController::class, 'destroy'])->name('unfavorite');

    Route::get('/mypage', [AuthController::class, 'index']);

    Route::prefix('reservation')->group(function () {
        Route::post('/store/{shop}', [ReservationController::class, 'store'])->name('reservation');
        Route::delete('/destroy/{reservation}', [ReservationController::class, 'destroy'])->name('reservation.destroy');
        Route::get('/edit/{reservation}', [ReservationController::class, 'edit'])->name('reservation.edit');
        Route::post('/update/{reservation}', [ReservationController::class, 'update'])->name('reservation.update');
    });

    Route::prefix('review')->group(function () {
        Route::get('/{reservation}', [ReviewController::class, 'index'])->name('review');
        Route::post('/store/{reservation}', [ReviewController::class, 'store'])->name('review.store');
    });
});
