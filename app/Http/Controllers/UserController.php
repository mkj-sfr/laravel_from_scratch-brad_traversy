<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // Return create user form view
    public function create()
    {
        return view('users.create');
    }

    // Validate and store user
    public function store()
    {
        $formFields = request()->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => 'required|min:6|confirmed',
        ]);

        // use default laravel hashing or bcrypt
        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        auth()->login($user);

        return redirect('/')->with('success', 'User created and logged in!');
    }

    // Return login user form view
    public function login()
    {
        return view('users.login');
    }

    // Logout user
    public function logout()
    {
        request()->session()->invalidate();
//        request()->session()->regenerate();
//        invalidate also regenerates the session token

        return redirect('/')->with('success', 'User logged out!');
    }

    // Validate and login user
    public function authenticate()
    {
        $formFields = request()->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if(auth()->attempt($formFields)) {
            request()->session()->regenerate();

            return redirect('/')->with('success', 'User logged in!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
