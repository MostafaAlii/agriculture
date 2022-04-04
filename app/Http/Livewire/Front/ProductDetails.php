<?php

namespace App\Http\Livewire\Front;

use App\Models\Product;
use App\Models\Tag;
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
        $tags=Tag::get();
        $product = Product::findorfail($this->product_id);
        $newProducts = Product::latest()->limit(3)->get();
        $popProducts = Product::inRandomOrder()->get()->take(6);
        return view('livewire.front.product-details',compact('product','newProducts','tags','popProducts'))
                   ->layout('front.layouts.master2');
    }
}
