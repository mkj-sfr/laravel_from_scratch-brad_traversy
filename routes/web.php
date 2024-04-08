<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

Route::get('/', [ListingController::class, 'index']);

Route::get('/listing/{listing}', [ListingController::class, 'show']);
