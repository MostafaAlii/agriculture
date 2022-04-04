<?php

namespace App\Http\Livewire\Front;

use App\Models\Category;
use Livewire\Component;

class HeaderSearchComponent extends Component
{
    public $search;
    // public $product_cate;
    // public $product_cate_id;
    public function mount(){
        // $this->product_cate = 'All Category';
        // $this->fill(request()->only('search','product_cate','product_cate_id'));
        $this->fill(request()->only('search'));
    }

    public function render()
    {
        // $categories = Category::all();
        // return view('livewire.front.header-search-component',compact('categories'));
        return view('livewire.front.header-search-component');
    }
}
