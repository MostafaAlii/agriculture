<?php

namespace App\Http\Livewire\Front;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
class Shop extends Component
{
    use WithPagination;
    public $sorting;
    public $pagesize;

    public function mount(){
        $this->sorting = "default";
        $this->pagesize = 12;
    }

    public function store($product_id,$product_name,$product_price){
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item addded in cart');
        return redirect()->route('product.cart');
    }

    public function render()
    {
        $featuredProducts = Product::inRandomOrder()->limit(3)->get();
        if($this->sorting=='date'){
            $products = Product::orderByDesc('created_at')->paginate($this->pagesize);
          }elseif($this->sorting=='price'){
              $products = Product::orderBy('price')->paginate($this->pagesize);
          }elseif($this->sorting=='price-desc'){
              $products = Product::orderByDesc('price')->paginate($this->pagesize);
          }else{
              $products = Product::paginate($this->pagesize);
          }
        return view('livewire.front.shop',compact('products','featuredProducts'))
        ->layout('front.layouts.master2');
    }
}
