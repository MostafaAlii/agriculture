<?php
namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
class UserLoginRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            // 'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            // 'g-recaptcha-response' => 'required|captcha'
        ];
    }

    public function authenticate() {
        $this->ensureIsNotRateLimited();
        // if (auth('vendor')->attempt($this->only('email', 'password'), $this->boolean('remember')))
        // {
        //     RateLimiter::hit($this->throttleKey());

        //     throw ValidationException::withMessages([
        //         'email' => trans('auth.failed'),
        //     ]);
        // }
        $user = User::where('email',$this->login)
               ->orwhere('phone',$this->login)
               ->first();
        if(!$user || !Hash::check($this->password,$user->password))
        {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'login' => trans('Admin/auth.failed'),
            ]);
        }
        auth('vendor')->login($user,$this->boolean('remember'));
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
}
