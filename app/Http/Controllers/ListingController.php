<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        return view('listings.index', [
            'listings' => Listings::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    public function show(Listings $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    public function create()
    {
        return view('listings.create');
    }

    public function store()
    {
        $formFields = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'company' => ['required', 'unique:listings,company'],
            'location' => 'required',
            'email' => ['required', 'email', 'unique:listings,email'],
            'website' => 'url',
            'tags' => 'required',
        ]);
        if(request()->hasFile('logo')) {
            $formFields['logo'] = request()->file('logo')->store('logos', 'public');
        }

        Listings::create($formFields);

        return redirect('/')->with('success', 'Listing created!');
    }
}
