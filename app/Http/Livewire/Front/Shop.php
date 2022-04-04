<?php

namespace App\Http\Livewire\Front;

use App\Models\Product;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
class Shop extends Component
{
    use WithPagination;
    public $sorting;
    public $pagesize;
    public $min_price;
    public $max_price;

    public function mount(){
        $this->sorting = "default";
        $this->pagesize = 12;
        $this->min_price = 1;
        $this->max_price = 10000;
    }

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
        $tags=Tag::get();
        $newProducts = Product::latest()->limit(3)->get();
        if($this->sorting=='date'){
            $products = Product::whereBetween('price',[$this->min_price,$this->max_price])
            ->orderByDesc('created_at')->paginate($this->pagesize);
          }elseif($this->sorting=='price'){
              $products = Product::whereBetween('price',[$this->min_price,$this->max_price])
              ->orderBy('price')->paginate($this->pagesize);
          }elseif($this->sorting=='price-desc'){
              $products = Product::whereBetween('price',[$this->min_price,$this->max_price])
              ->orderByDesc('price')->paginate($this->pagesize);
          }else{
              $products = Product::whereBetween('price',[$this->min_price,$this->max_price])
              ->paginate($this->pagesize);
          }
        return view('livewire.front.shop',compact('products','newProducts','tags'))
        ->layout('front.layouts.master2');
    }
}
