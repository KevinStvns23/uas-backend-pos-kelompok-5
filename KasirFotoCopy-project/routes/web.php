<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\DiscountController;

Route::get('/', [CategoryController::class, 'index']);

Route::resource('categories', CategoryController::class);
Route::resource('sub-categories', SubCategoryController::class);
Route::resource('discounts', DiscountController::class);
=======

Route::get('/', function () {
    return view('welcome');
});
>>>>>>> 173a24f142912d3eac03b1b7f845293e150331de
