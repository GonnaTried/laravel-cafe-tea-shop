<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\Staff\OrderController as StaffOrderController; // Example staff controller

Route::middleware(['auth', 'staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/', [StaffDashboardController::class, 'index'])->name('dashboard');
});
