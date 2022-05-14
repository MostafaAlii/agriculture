<?php

namespace App\Http\Livewire\Front\Worker;

use App\Models\Worker;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WorkerChangePassword extends Component
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
        if(Hash::check($this->current_password , Auth::guard('worker')->user()->password)){
           $user = Worker::findOrFail(Auth::guard('worker')->user()->id);
           $user->password = Hash::make($this->password);
           $user->save();
           session()->flash('password_message',__("Website/home.smschangepass"));
        }else{
           session()->flash('password_error',__("Website/home.smspassnotmatch"));
        }
     }
    public function render()
    {
        return view('livewire.front.worker.worker-change-password')->layout('front.layouts.master2');
    }
}
