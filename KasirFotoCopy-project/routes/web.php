<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncomeReportController;
use App\Http\Controllers\StockReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reports/income', [IncomeReportController::class, 'index']);

Route::get('/reports/stock', [StockReportController::class, 'index']);