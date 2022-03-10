<?php

namespace App\Http\Livewire\Front\Farmer;

use Livewire\Component;

class Product extends Component
{
    public function render()
    {
        return view('livewire.front.farmer.product')->layout('front.layouts.master2');
    }
}
