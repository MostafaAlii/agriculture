<?php

namespace App\Http\Livewire\Front\Farmer;

use App\Models\Farmer;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FarmerChangePassword extends Component
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
       if(Hash::check($this->current_password , Auth::guard('web')->user()->password)){
          $user = Farmer::findOrFail(Auth::guard('web')->user()->id);
          $user->password = Hash::make($this->password);
          $user->save();
          session()->flash('password_message',__("Website/home.smschangepass"));
       }else{
          session()->flash('password_error',__("Website/home.smspassnotmatch"));
       }
    }
    public function render()
    {
        return view('livewire.front.farmer.farmer-change-password')->layout('front.layouts.master2');
    }
}
