<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\FarmerRegisterRequest;
use App\Models\Farmer;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredFarmerController extends Controller
{

    public function store(FarmerRegisterRequest $request)
    {
        // $request->validate([
        //     'firstname'    => ['required', 'string', 'max:255'],
        //     'lastname'     => ['required', 'string', 'max:255'],
        //     'phone'        => 'required_with:email|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:users',
        //     'email'        => ['required', 'string', 'email', 'max:255', 'unique:farmers'],
        //     'password'     => ['required','confirmed'],
        // ]);
        // dd($request->all());
        $requestData = $request->validated();
        $farmer = Farmer::create([
            'firstname'    => $request->firstname,
            'lastname'     => $request->lastname,
            'phone'        => $request->phone,
            'email'        => $request->email,
            'password'     => bcrypt($request->password),
        ]);

        event(new Registered($farmer));

        Auth::login($farmer);

        // return redirect(RouteServiceProvider::FRONT);
        return redirect()->route('front');
    }
}
