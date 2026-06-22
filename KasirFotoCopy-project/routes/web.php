<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AbsensiController; 

//Controller Milik Yovan (Produk)
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\UnitController;

//Controller Milik Sept (Kategori)
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\CatalogDiscountController;

//Halaman Utama
Route::get('/', [CategoryController::class, 'index']);

//Produk
Route::resource('products', ProductController::class);
Route::resource('discounts', DiscountController::class);
Route::resource('units', UnitController::class);

//Kategori
Route::resource('categories', CategoryController::class);
Route::resource('sub-categories', SubCategoryController::class);
Route::resource('catalog-discounts', CatalogDiscountController::class)->except(['show']);
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    
    Route::post('/user/{user}/reset-password', [UserController::class, 'resetPassword'])->name('user.reset-password');
    Route::get('/user/{user}/cetak-data', [UserController::class, 'cetakData'])->name('user.cetak-data');
    
    Route::patch('/user/status/{id}', [UserController::class, 'updateStatus'])->name('user.updateStatus');
    
    Route::resource('user', UserController::class);

    
    Route::post('/absensi/checkin', [AbsensiController::class, 'checkIn'])->name('absensi.checkin');
    Route::post('/absensi/checkout', [AbsensiController::class, 'checkOut'])->name('absensi.checkout');
    
    Route::get('/absensi/rekap', [AbsensiController::class, 'rekap'])->name('absensi.rekap');
});
