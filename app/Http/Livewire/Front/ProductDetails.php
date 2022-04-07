<?php

namespace App\Http\Livewire\Front;

use App\Models\Product;
use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use Cart;

class ProductDetails extends Component
{
    public $product_id;
    public $qty=1;
    public function mount($product_id){
        $this->product_id = Crypt::decrypt($product_id);
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
        // $tags=Tag::get();
        $product = Product::findorfail($this->product_id);
        $newProducts = Product::latest()->limit(3)->get();
        $popProducts = Product::inRandomOrder()->get()->take(3);

        //retreive product comments
        $comments = $product->comments()->whereNull('parent_id')->orderby('id','desc')->simplePaginate(5);

        return view('livewire.front.product-details',compact('product','newProducts','popProducts','comments'))
                   ->layout('front.layouts.master2');
    }
}
