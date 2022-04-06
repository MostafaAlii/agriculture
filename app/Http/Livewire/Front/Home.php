<?php

namespace App\Http\Livewire\Front;

use App\Models\Product;
use Livewire\Component;
use Cart;
use Illuminate\Support\Facades\Auth;

class Home extends Component
{
    public function store($product_id,$product_name,$product_price){
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item addded in cart');
        return redirect()->route('product.cart');
    }
    public function addToWishlist($product_id,$product_name,$product_price){
        Cart::instance('wishlist')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        $this->emitTo('front.wishlist-count-component','refreshComponent');
    }
    public function removeWishlist($product_id){
        foreach(Cart::instance('wishlist')->content() as $item){
          if($item->id == $product_id){
             Cart::instance('wishlist')->remove($item->rowId);
             $this->emitTo('front.wishlist-count-component','refreshComponent');
             return;
          }
        }
     }

    public function render()
    {
        $newProducts = Product::latest()->limit(12)->get();
        $popProducts = Product::inRandomOrder()->get()->take(6);
        $saleProducts = Product::where('special_price','>',0)
                                 ->where('in_stock','1')
                                 ->latest()->get()->take(4);
        if(Auth::guard('vendor')->check()){
            Cart::instance('cart')->restore(Auth::guard('vendor')->user()->email);
            Cart::instance('wishlist')->restore(Auth::guard('vendor')->user()->email);
          }
        return view('livewire.front.home',compact('popProducts','saleProducts','newProducts'))
        ->layout('front.layouts.master1');
    }
}
