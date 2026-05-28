<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\UnitController;

Route::get('/', function () {
    return redirect('/products');
});

Route::resource('products', ProductController::class);
Route::resource('discounts', DiscountController::class);
Route::resource('units', UnitController::class);