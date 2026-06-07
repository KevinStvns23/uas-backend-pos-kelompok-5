<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\DiscountController;

Route::get('/', [CategoryController::class, 'index']);

Route::resource('categories', CategoryController::class)->except(['show']);
Route::resource('sub-categories', SubCategoryController::class)->except(['show']);
Route::resource('discounts', DiscountController::class)->except(['show']);