<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('customer.home');
})->name('home');

Route::get('/about', function () {
    return view('customer.about');
})->name('about');

Route::get('/services', function () {
    return view('customer.services');
})->name('services');

Route::get('/help', function () {
    return view('customer.help');
})->name('help');

Route::get('/login', function () {
    return view('customer.login');
})->name('login');
Route::get('/signup', function () { return view('customer.signup'); })->name('signup');
Route::get('/profile', function () { return view('customer.profile'); })->name('profile');
