<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
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