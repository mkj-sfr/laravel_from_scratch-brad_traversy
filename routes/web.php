<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;


Route::get('/', [ListingController::class, 'index']);

Route::get('/listing/create', [ListingController::class, 'create'])->middleware('auth');

Route::post('/listing', [ListingController::class, 'store'])->middleware('auth');

Route::get('listing/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

Route::put('listing/{listing}', [ListingController::class, 'update'])->middleware('auth');

Route::delete('listing/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

Route::get('/listing/{listing}', [ListingController::class, 'show']);

Route::get('/register', [UserController::class, 'create'])->middleware('guest');

Route::post('/register', [UserController::class, 'store']);

Route::get('/login', [UserController::class, 'login'])->middleware('guest')->name('login');

Route::post('/login', [UserController::class, 'authenticate']);

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
