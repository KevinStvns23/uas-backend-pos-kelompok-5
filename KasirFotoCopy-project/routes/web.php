<?php

use Illuminate\Support\Facades\Route;

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
Route::resource('categories', CategoryController::class)->except(['show']);
Route::resource('sub-categories', SubCategoryController::class)->except(['show']);
Route::resource('catalog-discounts', CatalogDiscountController::class)->except(['show']);