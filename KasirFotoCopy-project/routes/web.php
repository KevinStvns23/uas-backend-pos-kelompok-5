<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\CatalogDiscountController;

Route::get('/', [CategoryController::class, 'index']);

Route::resource('categories', CategoryController::class);
Route::resource('sub-categories', SubCategoryController::class);
Route::resource('catalog-discounts', CatalogDiscountController::class)->except(['show']);