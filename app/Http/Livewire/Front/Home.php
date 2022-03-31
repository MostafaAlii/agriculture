<?php

namespace App\Http\Livewire\Front;

use App\Models\Product;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $newProducts = Product::latest()->limit(6)->get();
        $featuredProducts = Product::inRandomOrder()->limit(4)->get();
        return view('livewire.front.home',compact('newProducts','featuredProducts'))
        ->layout('front.layouts.master1');
    }
}
