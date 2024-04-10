<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

// Home page
Route::get('/', [ListingController::class, 'index']);

// Show create listing form
Route::get('/listing/create', [ListingController::class, 'create'])->middleware('auth');

// Store new listing
Route::post('/listing', [ListingController::class, 'store'])->middleware('auth');

// Show edit listing form
Route::get('listing/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update edited listing
Route::put('listing/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete listing
Route::delete('listing/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Show manage listings page
Route::get('listing/manage', [ListingController::class, 'manage'])->middleware('auth');

// Show single listing page
Route::get('/listing/{listing}', [ListingController::class, 'show']);



// Show register form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Store registered user
Route::post('/register', [UserController::class, 'store']);

// Show login form
Route::get('/login', [UserController::class, 'login'])->middleware('guest')->name('login');

// Login user
Route::post('/login', [UserController::class, 'authenticate']);

// Logout user
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
