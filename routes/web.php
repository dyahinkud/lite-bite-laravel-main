<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\PaymentController;

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/menu', [FrontendController::class, 'menu'])->name('menu');
Route::get('/menu/{id}', [FrontendController::class, 'productDetail'])->name('menu.detail');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/location', [FrontendController::class, 'location'])->name('location');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// User Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index');

    Route::get('/profile', [\App\Http\Controllers\User\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\User\ProfileController::class, 'update'])->name('profile.update');

    Route::get('/cart', [\App\Http\Controllers\User\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product_id}', [\App\Http\Controllers\User\CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{cart_item_id}', [\App\Http\Controllers\User\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cart_item_id}', [\App\Http\Controllers\User\CartController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

    Route::get('/payment/{order_id}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{order_id}/process', [PaymentController::class, 'process'])->name('payment.process');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('/reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
    Route::resource('users', UserController::class);
});
