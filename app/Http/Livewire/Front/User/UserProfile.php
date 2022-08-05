<?php

namespace App\Http\Livewire\Front\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserProfile extends Component
{
    public function render()
    {
        $user = User::find(Auth::guard('vendor')->user()->id);
        return view('livewire.front.user.user-profile',compact('user'))->layout('front.layouts.master2');
    }
}
