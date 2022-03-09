<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.front.home')->layout('front.layouts.master1');
    }
}
