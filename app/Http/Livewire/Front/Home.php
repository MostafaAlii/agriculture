<?php

namespace App\Http\Livewire\Front;

use App\Models\Product;
use Livewire\Component;
use Cart;
class Home extends Component
{
    public function store($product_id,$product_name,$product_price){
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item addded in cart');
        return redirect()->route('product.cart');
    }

    public function render()
    {
        $newProducts = Product::latest()->limit(6)->get();
        $featuredProducts = Product::inRandomOrder()->limit(4)->get();
        return view('livewire.front.home',compact('newProducts','featuredProducts'))
        ->layout('front.layouts.master1');
    }
}
