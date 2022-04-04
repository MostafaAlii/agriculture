<?php

namespace App\Http\Livewire\Front;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Cart;
class Home2 extends Component
{
    public function render()
    {
        if(Auth::guard('vendor')->check()){
            Cart::instance('cart')->restore(Auth::guard('vendor')->user()->email);
          }
        return view('livewire.front.home2')->layout('front.layouts.master');
    }
}
