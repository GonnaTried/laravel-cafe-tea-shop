<?php

use App\Http\Controllers\CoffeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TeaController;
use App\Http\Controllers\ViewItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use Illuminate\Routing\ViewController;
use Illuminate\Support\Facades\Route;

// admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MenuItemController as AdminMenuItemController;

// Route::get('/', function () {
//     return view('frontend.home.index');
// });
// Route::get('home', function () {
//     return view('frontend.home.index');
// });

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);

Route::get('/tea', [TeaController::class, 'index']);
Route::get('/coffee', [CoffeeController::class, 'index']);
Route::get('/location', [LocationController::class, 'index']);

// View Item
Route::get('/viewItem/{slug}', [ViewItemController::class, 'index'])->name('viewItem.index');

// Order
Route::post('/order/place', [OrderController::class, 'placeOrder'])->middleware('auth')->name('order.place');
Route::get('/order/{order}', [OrderController::class, 'showConfirmation'])->name('order.confirmation');
Route::get('/order-history', [OrderController::class, 'showOrderHistory'])->middleware('auth')->name('order.history');

// cart
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::delete('/cart/remove/{cartItemId}', [CartController::class, 'removeCartItem'])->name('cart.remove');

// Auth
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// terms and conditions
Route::get('/terms-and-conditions', function () {
    return view('terms.index');
})->name('terms');

// Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Admin Dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // Routes for managing Menu Items (example)
    Route::get('/menu-items', [AdminMenuItemController::class, 'index'])->name('admin.menu-items.index');
    Route::get('/menu-items/create', [AdminMenuItemController::class, 'create'])->name('admin.menu-items.create');
    Route::post('/menu-items', [AdminMenuItemController::class, 'store'])->name('admin.menu-items.store');
    Route::get('/menu-items/{menuItem}/edit', [AdminMenuItemController::class, 'edit'])->name('admin.menu-items.edit');
    Route::put('/menu-items/{menuItem}', [AdminMenuItemController::class, 'update'])->name('admin.menu-items.update');
    Route::delete('/menu-items/{menuItem}', [AdminMenuItemController::class, 'destroy'])->name('admin.menu-items.destroy');

    // Add routes for managing Categories, ItemOptions, Orders, Users etc.
    // Route::resource('categories', AdminCategoryController::class); // Example using resource routes
});
