<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\MediaController;

// ─── Customer Frontend Routes ─────────────────────────────────────────────────
Route::get('/', function () { return view('customer.home'); })->name('home');
Route::get('/about', function () { return view('customer.about'); })->name('about');
Route::get('/services', function () { return view('customer.services'); })->name('services');
Route::get('/help', function () { return view('customer.help'); })->name('help');
Route::get('/login', function () { return view('customer.login'); })->name('login');
Route::get('/signup', function () { return view('customer.signup'); })->name('signup');
Route::get('/profile', function () { return view('customer.profile'); })->name('profile');

// ─── Admin Panel Routes ───────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    // Public (auth not required)
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected (requires admin session)
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/', fn() => redirect()->route('admin.dashboard'));

        // Customers (no create/store — customers register on frontend)
        Route::resource('customers', CustomerController::class)
            ->except(['show']);

        // Orders
        Route::resource('orders', OrderController::class);

        // Plans
        Route::resource('plans', PlanController::class);

        // Offers
        Route::resource('offers', OfferController::class);

        // Media (video & pdf)
        Route::resource('media', MediaController::class)
            ->except(['show', 'edit', 'update']);
    });
});
