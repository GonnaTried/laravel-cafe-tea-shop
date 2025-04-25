<?php

use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Staff\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;

Route::middleware(['auth', 'staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/', [StaffDashboardController::class, 'index'])->name('dashboard');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/accept', [OrderController::class, 'accept'])->name('orders.accept');
    Route::post('/orders/{order}/deny', [OrderController::class, 'deny'])->name('orders.deny');
    Route::post('/orders/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');
});
