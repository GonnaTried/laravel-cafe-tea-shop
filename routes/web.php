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
require __DIR__ . '/admin.php';

// Staff
require __DIR__ . '/staff.php';

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

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

// admin
// Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
//     Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

//     // Example Admin User Management Routes
//     // Route::resource('users', AdminUserController::class);
// });
