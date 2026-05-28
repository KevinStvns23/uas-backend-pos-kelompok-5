<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\DiscountController;

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('categories', CategoryController::class);
Route::apiResource('sub-categories', SubCategoryController::class);
Route::apiResource('discounts', DiscountController::class);