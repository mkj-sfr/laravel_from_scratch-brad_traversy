<?php

use Illuminate\Support\Facades\Route;
use App\Models\Listings;

Route::get('/', function () {
    return view('listings', [
        'header' => 'Listing',
        'listings' => Listings::all()
    ]);
});

Route::get('/listing/{listing}', function(Listings $listing) {
    return view('listing', [
        'header' => 'Found Listing',
        'listing' => $listing
    ]);
});
