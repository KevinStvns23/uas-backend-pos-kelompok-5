<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncomeReportController;
use App\Http\Controllers\StockReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AbsensiController; 

//Controller Milik Yovan (Produk)
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\OrderController;

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

Route::get('/orders', function () {
    return redirect('/orders/create');
});
Route::get('/orders/create', [OrderController::class, 'create']);
Route::post('/orders/add', [OrderController::class, 'addToCart']);
Route::post('/orders/update/{index}', [OrderController::class, 'updateQuantity']);
Route::post('/orders/delete/{index}', [OrderController::class, 'deleteItem']);
Route::post('/orders/checkout', [OrderController::class, 'checkout']);
Route::get('/orders/checkout', [OrderController::class, 'showCheckout']);
Route::post('/orders/apply-promo', [OrderController::class, 'applyPromo']);
Route::get('/orders/receipt', [OrderController::class, 'receipt']);
Route::post('/orders/reset', [OrderController::class, 'resetTransaction']);

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

Route::get('/reports/income', [IncomeReportController::class, 'index']);

Route::get('/reports/stock', [StockReportController::class, 'index']);