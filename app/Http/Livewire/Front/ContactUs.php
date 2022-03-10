<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class ContactUs extends Component
{
    public function render()
    {
        return view('livewire.front.contact-us')->layout('front.layouts.master3');
    }
}
