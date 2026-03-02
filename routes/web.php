<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\ReviewController;

use App\Http\Controllers\Customer\ServiceController;
use App\Http\Controllers\Customer\Auth\LoginController;
use App\Http\Controllers\Customer\Auth\RegisterController;
use App\Http\Controllers\Customer\ProfileController;

// ─── Customer Frontend Routes ─────────────────────────────────────────────────
Route::get('/', function () { 
    $reviews = \App\Models\Review::where('is_active', true)->latest()->take(6)->get();
    $media = \App\Models\MediaUpload::latest()->get();
    return view('customer.home', compact('reviews', 'media')); 
})->name('home');
Route::get('/about', function () { return view('customer.about'); })->name('about');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/help', function () { return view('customer.help'); })->name('help');
Route::post('/reviews', [\App\Http\Controllers\Customer\PublicReviewController::class, 'store'])->name('reviews.store');

// Guest routes
Route::middleware('guest:customer')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/signup', [RegisterController::class, 'showRegistrationForm'])->name('signup');
    Route::post('/signup', [RegisterController::class, 'register'])->name('signup.post');
});

// Auth routes
Route::middleware('auth:customer')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout.customer');
});

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
        Route::post('customers/bulk-delete', [CustomerController::class, 'bulkDelete'])->name('customers.bulk-delete');
        Route::post('orders/bulk-delete', [OrderController::class, 'bulkDelete'])->name('orders.bulk-delete');
        Route::post('plans/bulk-delete', [PlanController::class, 'bulkDelete'])->name('plans.bulk-delete');
        Route::post('offers/bulk-delete', [OfferController::class, 'bulkDelete'])->name('offers.bulk-delete');
        Route::post('media/bulk-delete', [MediaController::class, 'bulkDelete'])->name('media.bulk-delete');
        Route::post('reviews/bulk-delete', [ReviewController::class, 'bulkDelete'])->name('reviews.bulk-delete');
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

        // Reviews
        Route::resource('reviews', ReviewController::class);
    });
});
