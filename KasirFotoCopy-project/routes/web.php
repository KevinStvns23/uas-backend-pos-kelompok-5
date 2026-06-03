<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('categories');
});

Route::get('/sub-categories', function () {
    return view('sub-categories');
});

Route::get('/discounts', function () {
    return view('discounts');
});