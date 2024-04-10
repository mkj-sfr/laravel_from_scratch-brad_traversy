<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{

    // Return home page view
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    // Return listing single page view
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Return create listing form view
    public function create()
    {
        return view('listings.create');
    }

    // Validate and create listing
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

        Listing::create($formFields);

        return redirect('/')->with('success', 'Listing created!');
    }

    // Return edit listing form view
    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    // Validate and update listing
    public function update(Listing $listing)
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

    // Delete listing
    public function destroy(Listing $listing)
    {
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $listing->delete();

        return redirect('/')->with('success', 'Listing deleted!');
    }

    // Return manage listings view
    public function manage()
    {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
