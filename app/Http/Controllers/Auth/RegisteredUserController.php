<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    // public function create()
    // {
    //     return view('auth.register');
    // }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname'    => ['required', 'string', 'max:255'],
            'lastname'     => ['required', 'string', 'max:255'],
            'phone'        => 'required_with:email|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:users',
            'email'        => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'     => ['required','confirmed'],
        ]);
        // dd($request->all());

        $user = User::create([
            'firstname'    => $request->firstname,
            'lastname'     => $request->lastname,
            'phone'        => $request->phone,
            'email'        => $request->email,
            'password'     => bcrypt($request->password),
        ]);

        event(new Registered($user));

        auth('vendor')->login($user);

        // return redirect(RouteServiceProvider::FRONT);
        return redirect()->route('front');
    }
}
