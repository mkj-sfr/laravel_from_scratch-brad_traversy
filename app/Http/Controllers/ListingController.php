<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        return view('listings.index', [
            'listings' => Listings::latest()->filter(request(['tag', 'search']))->get()
        ]);
    }

    public function show(Listings $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }
}
