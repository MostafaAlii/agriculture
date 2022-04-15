<?php

namespace App\Http\Livewire\Front;

use auth;
use Cart;
use App\Models\Tag;
use App\Models\Rating;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\Securities\Rates;

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
        $newProducts = Product::where('in_stock',1)->where('qty','>',0)->latest()->limit(3)->get();
        $popProducts = Product::where('in_stock',1)->where('qty','>',0)->inRandomOrder()->get()->take(3);

        //retreive product comments
        $comments = $product->comments()->whereNull('parent_id')->orderby('id','desc')->simplePaginate(5);

       // dd(auth()->user()->id);
        //$product->ratings->where('user_id',auth()->user()->id);

        //product total rate
        if($product->ratings->count()){
            $productSum = $product->ratings->sum(function($item){ // $item is related to the guardTable (User or Other)
                return $item->pivot->rating;
            });
            $avg = 10*($productSum / $product->ratings->count());
        }else{
            $avg=0;
        }
        return view('livewire.front.product-details',compact('product','newProducts','popProducts','comments','avg'))
                   ->layout('front.layouts.master2');
    }
}
