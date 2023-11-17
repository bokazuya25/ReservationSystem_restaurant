<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WriterController;
use App\Models\Reservation;
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
Route::view('/reservation/confirm/scan','scan');

Route::get('/', [ShopController::class, 'index']);
Route::get('/search', [ShopController::class, 'search'])->name('search');

Route::get('/detail/{shop_id}', [ShopController::class, 'detail']);
Route::get('/review/shop/{shop_id}', [ReviewController::class, 'list']);

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

Route::post('/admin/register/shopRepresentative',[AdminController::class,'register'])->middleware(['auth','role:admin']);
Route::get('/admin/user/index',[AdminController::class,'userShow'])->middleware(['auth','role:admin']);
Route::get('admin/search-users/index',[AdminController::class,'search']);

Route::view('/admin/register','admin.register_shopRepresentative')->middleware(['auth','role:admin'])->name('admin.register');
Route::view('/admin/email-notification','admin.email_notification')->middleware(['auth','role:admin'])->name('admin.notification');

Route::post('/admin/email-notification',[MailController::class,'sendNotification'])->name('send.notification');

Route::get('/writer/shop-edit',[WriterController::class,'editShow'])->middleware('auth','role:admin|writer');
Route::post('/writer/shop-edit',[WriterController::class,'create_and_edit'])->middleware('auth','role:admin|writer');

Route::get('/writer/confirm/shop-reservation',[WriterController::class,'reservationShow'])->middleware('auth','role:admin|writer');

Route::patch('/writer/update/shop-reservation',[WriterController::class,'update'])->middleware('auth','role:admin|writer');

Route::delete('/writer/destroy/shop-reservation',[WriterController::class,'destroy'])->middleware('auth','role:admin|writer');

Route::get('/reservation/confirm/{reservation}',[ReservationController::class,'confirm'])->middleware('signed')->name('reservation.confirm');