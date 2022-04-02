<?php

namespace App\Http\Livewire\Front;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class SearchComponent extends Component
{
    use WithPagination;
    public $sorting;
    public $pagesize;
    public $search;
    // public $product_cate;
    // public $product_cate_id;

    public function mount(){
        $this->sorting = "default";
        $this->pagesize = 12;
        // $this->fill(request()->only('search','product_cate','product_cate_id'));
        $this->fill(request()->only('search'));
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
            $products =Product::whereHas('translations', function ($query) {
                $query->where('name','like','%'.$this->search.'%');
            })->orderByDesc('created_at')->paginate($this->pagesize);
        }elseif($this->sorting=='price'){
            $products =Product::whereHas('translations', function ($query) {
                $query->where('name','like','%'.$this->search.'%');
            })->orderBy('price')->paginate($this->pagesize);
        }elseif($this->sorting=='price-desc'){
            $products =Product::whereHas('translations', function ($query) {
                $query->where('name','like','%'.$this->search.'%');
            })->orderByDesc('price')->paginate($this->pagesize);
        }else{
            $products =Product::whereHas('translations', function ($query) {
                $query->where('name','like','%'.$this->search.'%');
            })->paginate($this->pagesize);
        }
        return view('livewire.front.search-component',compact('products','featuredProducts'))
        ->layout('front.layouts.master2');
    }

}
