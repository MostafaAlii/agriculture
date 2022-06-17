<?php

namespace App\Http\Livewire\Front;

use Cart;
use App\Models\Tag;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\ProductTranslation;
use App\Models\Unit;
use App\Models\UnitTranslation;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

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
        $data['tags']=Tag::get();
        $data['newProducts'] = Product::where('stock',1)->where('qty','>',0)->latest()->limit(3)->get();

        // if($this->sorting=='date'){
        //     $data['products'] = Product::whereBetween('price',[$this->min_price,$this->max_price])
        //     ->where('stock',1)->where('qty','>',0)->orderByDesc('created_at')->paginate($this->pagesize);
        //   }elseif($this->sorting=='price'){
        //       $data['products'] = Product::whereBetween('price',[$this->min_price,$this->max_price])
        //       ->where('stock',1)->where('qty','>',0)->orderBy('price')->paginate($this->pagesize);
        //   }elseif($this->sorting=='price-desc'){
        //       $data['products'] = Product::whereBetween('price',[$this->min_price,$this->max_price])
        //       ->where('stock',1)->where('qty','>',0)->orderByDesc('price')->paginate($this->pagesize);
        //   }else{
        //       $data['products'] = Product::whereBetween('price',[$this->min_price,$this->max_price])
        //       ->where('stock',1)->where('qty','>',0)->paginate($this->pagesize);
        //   }
        $data['products'] = Product::orderByDesc('created_at')->get();
          if(Auth::guard('vendor')->check()){
            Cart::instance('cart')->store(Auth::guard('vendor')->user()->email);
            Cart::instance('wishlist')->store(Auth::guard('vendor')->user()->email);
          }
          $data['home_category']=Category::whereNotNull('parent_id')->inRandomOrder()->get();

        return view('livewire.front.shop',$data)
        ->layout('front.layouts.master2');
    }
}
