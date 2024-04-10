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

        $formFields['user_id'] = auth()->id();

        Listings::create($formFields);

        return redirect('/')->with('success', 'Listing created!');
    }

    public function edit(Listings $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    public function update(Listings $listing)
    {
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $formFields = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'company' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'url',
            'tags' => 'required',
        ]);
        if(request()->hasFile('logo')) {
            $formFields['logo'] = request()->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('success', 'Listing updated!');
    }

    public function destroy(Listings $listing)
    {
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $listing->delete();

        return redirect('/')->with('success', 'Listing deleted!');
    }

    public function manage()
    {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
