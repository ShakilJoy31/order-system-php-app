<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Redirect the home page to the order form
Route::get('/', function () {
    return redirect()->route('orders.create');
});

// Show the order form
Route::get('/orders/create', [OrderController::class, 'create'])
    ->name('orders.create');

// Save the order to the database
Route::post('/orders', [OrderController::class, 'store'])
    ->name('orders.store');