<?php

namespace App\Http\Livewire\Front;

use App\Models\Product;
use Livewire\Component;
use Cart;

class ProductDetails extends Component
{
    public $product_id;
    public $qty=1;
    public function mount($product_id){
        $this->product_id = $product_id;
    }
    public function store($product_id,$product_name,$product_price){
        Cart::instance('cart')->add($product_id,$product_name,$this->qty,$product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item addded in cart');
        return redirect()->route('product.cart');
    }
    public function increaseQty(){
        $this->qty++;
    }
    public function decreaseQty(){
        if($this->qty > 1){
            $this->qty--;
        }
    }
    public function render()
    {
        $product = Product::findorfail($this->product_id);
        $featuredProducts = Product::inRandomOrder()->limit(3)->get();
        return view('livewire.front.product-details',compact('product','featuredProducts'))
                   ->layout('front.layouts.master2');
    }
}
