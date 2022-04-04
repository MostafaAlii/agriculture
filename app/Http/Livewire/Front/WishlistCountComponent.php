<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class WishlistCountComponent extends Component
{
    protected $listeners = ['refreshComponent'=>'$refresh'];
    public function render()
    {
        return view('livewire.front.wishlist-count-component');
    }
}
