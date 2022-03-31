<?php

namespace App\Http\Livewire\Front;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;
    public $sorting;
    public $pagesize;

    public function mount(){
        $this->sorting = "default";
        $this->pagesize = 12;
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
