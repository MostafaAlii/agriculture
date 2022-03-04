<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class Shop extends Component
{
    public function render()
    {
        return view('livewire.front.shop')->layout('front.layoutsShop.master2');
    }
}
