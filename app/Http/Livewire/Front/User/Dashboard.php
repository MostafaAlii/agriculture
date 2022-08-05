<?php

namespace App\Http\Livewire\Front\User;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.front.user.dashboard')->layout('front.layouts.master2');
    }
}
