<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

Route::get('/', [ListingController::class, 'index']);

Route::get('/listing/create', [ListingController::class, 'create']);

Route::post('/listing', [ListingController::class, 'store']);

Route::get('/listing/{listing}', [ListingController::class, 'show']);
