<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Cartalyst\Support\Validator;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use Mail;
class PasswordResetLinkController extends Controller
{

    public function create()
    {
        // return view('auth.forgot-password');
        return view('front.user.auth.user-forget');
    }


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         // 'email' => ['required', 'email'],
    //     ]);

    //     // We will send the password reset link to this user. Once we have attempted
    //     // to send the link, we will examine the response then see the message we
    //     // need to show to the user. Finally, we'll send out a proper response.
    //     // $status = Password::sendResetLink(
    //     //     $request->only('email')

    //     // );

    //     // return $status == Password::RESET_LINK_SENT
    //     //             ? back()->with('status', __($status))
    //     //             : back()->withInput($request->only('email'))
    //     //                     ->withErrors(['email' => __($status)]);

    //     $user = DB::table('users')->where('email', '=', $request->email)
    //         ->first();
    //     //Check if the user exists
    //     if ($user == null) {
    //         return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
    //     }
    //     $pin = rand(100000, 999999);
    //     //Create Password Reset Token
    //     DB::table('password_resets')->insert([
    //         'email' => $request->email,
    //         // 'token' => Str::random(40),
    //         'token' => $pin,
    //         'created_at' => Carbon::now()
    //     ]);
    //     //Get the token just created above
    //     $tokenData = DB::table('password_resets')
    //         ->where('email', $request->email)->first();

    //     if ($this->sendResetEmail($request->email, $tokenData->token)) {
    //         return redirect()->back()->with('status', trans('A reset link has been sent to your email address.'));
    //     } else {
    //         return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
    //     }
    // }

    // private function sendResetEmail($email, $token)
    // {
    //     //Retrieve the user from the database
    //     $user = DB::table('users')->where('email', $email)->select('firstname', 'email')->first();
    //     //Generate, the password reset link. The token generated is embedded in the link
    //     // $link = 'http://localhost/' . 'reset-password/' . $token . '?email=' . urlencode($user->email);
    //     // $url = 'https://example.com/reset-password?token='.$token;

    //     // $this->notify(new \App\Notifications\UserForget($user->email,$token));
    //     // Notification::send($email, new \App\Notifications\UserForget($email,$token));

    //     // Mail::to($user->email)->send(new VerifyEmail($token));

    //         try {
    //         //Here send the link with CURL with an external email API
    //             return true;
    //         } catch (\Exception $e) {
    //             return false;
    //         }
    // }

    // public function forgetPasswordPost(){
    //     $admin = Admin::where('email',request('email'))->first();
    //     if(!empty($admin)){
    //         $token = app('auth.password.broker')->createToken($admin);
    //         $data = DB::table('password_resets')->insert([
    //             'email'=>$admin->email,
    //             'token'=>$token,
    //             'created_at'=> Carbon::now()
    //         ]);
    //         Mail::to($admin->email)->send(new AdminResetPassword(['data'=>$admin ,'token'=>$token]));
    //         return redirect()->back()->with('status', trans('A reset link has been sent to your email address.'));
    //     }
    //     return back();

    // }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $user = DB::table('users')->where('email', '=', $request->email)
        ->first();
        //Check if the user exists
        if ($user == null) {
            return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
        }
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
          ]);
        Mail::send('front.user.auth.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return redirect()->back()->with('status', __('Website/home.sendresetsms'));
    }

}
