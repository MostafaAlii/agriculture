<?php

namespace App\Http\Livewire\Front\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserChangePassword extends Component
{
    public $current_password;
    public $password;
    public $confirm_password;

    public function updated($fields){
        $this->validateOnly($fields,[
            'current_password'  =>'required',
            'password'          =>'required|min:6|different:current_password',
            'confirm_password'  => 'required|min:6|same:password'
         ]);
    }
    public function changePassword(){
       $this->validate([
        'current_password'  =>'required',
        'password'          => 'required|min:6|different:current_password',
        'confirm_password'  => 'required|min:6|same:password'
       ]);
       if(Hash::check($this->current_password , Auth::guard('vendor')->user()->password)){
          $user = User::findOrFail(Auth::guard('vendor')->user()->id);
          $user->password = Hash::make($this->password);
          $user->save();
          session()->flash('password_message',__("Website/home.smschangepass"));
       }else{
          session()->flash('password_error',__("Website/home.smspassnotmatch"));
       }
    }
    public function render()
    {
        return view('livewire.front.user.user-change-password')
        ->layout('front.layouts.master2');
    }
}
