<?php

namespace App\Http\Livewire\Front;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;
    public function render()
    {
        $products = Product::latest()->paginate(9);
        return view('livewire.front.shop',compact('products'))
        ->layout('front.layouts.master2');
    }
}
