<?php
namespace App\Http\Requests\Auth;

use App\Models\Admin;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AdminLoginRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            //'email' => ['required', 'string', 'email'],
            //'password' => ['required', 'string'],
            // 'email' => 'required', 'string', 'email', 'max:255', 'unique:admins',
            'password' => 'required|string|min:6',
        ];
    }

    public function authenticate() {
        $this->ensureIsNotRateLimited();
        // if (auth('admin')->attempt($this->only('email', 'password'), $this->boolean('remember'))) {
        //     RateLimiter::hit($this->throttleKey());

        //     throw ValidationException::withMessages([
        //         'email' => trans('auth.failed'),
        //     ]);
        // }
        $admin = Admin::where('email',$this->login)
               ->orwhere('phone',$this->login)
               ->first();
        if(!$admin || !Hash::check($this->password,$admin->password))
        {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'login' => trans('Admin/auth.failed'),
            ]);
        }
        auth('admin')->login($admin,$this->boolean('remember'));
        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited() {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }
        event(new Lockout($this));
        $seconds = RateLimiter::availableIn($this->throttleKey());
        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey() {
        return Str::lower($this->input('email')).'|'.$this->ip();
    }

    public function messages()
    {
        return [
            'email.required'           =>  trans('Admin/login.email_required') ,
            'email.unique'           =>  trans('Admin/login.email_unique'),
            'email.string'          =>  trans('Admin/login.email_string'),
            'email.email' => trans('Admin/login.email_real_email'),
            'password.required'           =>  trans('Admin/login.password_required') ,
            'password.min'           =>  trans('Admin/login.password_min') ,
        ];
    }
}
