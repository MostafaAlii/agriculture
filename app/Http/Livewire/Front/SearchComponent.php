<?php

namespace App\Http\Livewire\Front;

use App\Models\Product;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class SearchComponent extends Component
{
    use WithPagination;
    public $sorting;
    public $pagesize;
    public $search;
    public $min_price;
    public $max_price;
    // public $product_cate;
    // public $product_cate_id;

    public function mount(){
        $this->sorting = "default";
        $this->pagesize = 12;
        $this->min_price = 1;
        $this->max_price = 10000;
        $this->fill(request()->only('search'));
    }

    public function store($product_id,$product_name,$product_price){
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        // session()->flash('success_message','Item addded in cart');
        // return redirect()->route('product.cart');
        $this->emitTo('front.cart-count-component','refreshComponent');
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
        $newProducts = Product::where('stock',1)->where('qty','>',0)->inRandomOrder()->limit(3)->get();

        if($this->sorting=='new_to_old'){
            $products =Product::whereHas('translations', function ($query) {
                $query->where('name','like','%'.$this->search.'%');
            })
            ->where('stock',1)
            ->orderByDesc('created_at')
            ->where('qty','>',0)
            ->paginate($this->pagesize);
        }elseif($this->sorting=='old_to_new'){
            $products =Product::whereHas('translations', function ($query) {
                $query->where('name','like','%'.$this->search.'%');
            })
            ->where('stock',1)
            ->orderBy('created_at')
            ->where('qty','>',0)
            ->paginate($this->pagesize);
        }elseif($this->sorting=='price_high_to_low'){
            $products =Product::whereHas('translations', function ($query) {
                $query->where('name','like','%'.$this->search.'%');
            })
            ->where('stock',1)
            ->where('qty','>',0)
            ->where('special_price', 0)
            ->whereHas('units', function($q){
              $q->orderByDesc('price');
           })
              ->paginate($this->pagesize);
        }elseif($this->sorting=='price_low_to_high'){
            $products =Product::whereHas('translations', function ($query) {
                $query->where('name','like','%'.$this->search.'%');
            })
            ->where('stock',1)
            ->where('qty','>',0)
            ->where('special_price', 0)
            ->whereHas('units', function($q){
              $q->orderBy('price');
           })
              ->paginate($this->pagesize);
        }elseif($this->sorting=='newoffer_from_low_to_high'){
            $products =Product::whereHas('translations', function ($query) {
                $query->where('name','like','%'.$this->search.'%');
            })
            ->where('stock',1)
            ->where('special_price','>',0)
            ->orderBy('special_price')
            ->where('qty','>',0)
            ->paginate($this->pagesize);
        }elseif($this->sorting=='newoffer_from_high_to_low'){
            $products =Product::whereHas('translations', function ($query) {
                $query->where('name','like','%'.$this->search.'%');
            })
            ->where('stock',1)
            ->where('special_price','>',0)
            ->orderByDesc('special_price')
            ->where('qty','>',0)
            ->paginate($this->pagesize);
        }else{
            $products =Product::whereHas('translations', function ($query) {
                $query->where('name','like','%'.$this->search.'%');
            })
            ->where('stock',1)
            ->orderBy('created_at')
            ->paginate($this->pagesize);
        }
        // $products =Product::whereHas('translations', function ($query) {
        //             $query->where('name','like','%'.$this->search.'%');
        //         })->get();

        return view('livewire.front.search-component',compact('products','newProducts','tags'))
        ->layout('front.layouts.master2');
    }
}
