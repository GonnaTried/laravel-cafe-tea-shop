<?php

use App\Http\Controllers\CoffeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TeaController;
use App\Http\Controllers\ViewItemController;
use App\Http\Controllers\AuthController;
use Illuminate\Routing\ViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home.index');
});
Route::get('home', function () {
    return view('frontend.home.index');
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);

Route::get('/tea', [TeaController::class, 'index']);
Route::get('/coffee', [CoffeeController::class, 'index']);
Route::get('/location', [LocationController::class, 'index']);

// View Item
Route::get('/viewItem/{slug}', [ViewItemController::class, 'index'])->name('viewItem.index');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
