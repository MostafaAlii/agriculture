<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class Checkout extends Component
{
    public function render()
    {
        return view('livewire.front.checkout')
        ->layout('front.layouts.master2');
    }
}
