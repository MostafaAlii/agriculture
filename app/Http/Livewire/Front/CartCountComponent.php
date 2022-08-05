<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class CartCountComponent extends Component
{
    protected $listeners = ['refreshComponent'=>'$refresh'];
    public function render()
    {
        return view('livewire.front.cart-count-component');
    }
}
