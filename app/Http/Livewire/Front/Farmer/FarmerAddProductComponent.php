<?php

namespace App\Http\Livewire\Front\Farmer;

use App\Models\Category;
use App\Models\Farmer;
use App\Models\Tag;
use Livewire\Component;

class FarmerAddProductComponent extends Component
{
    public function render()
    {
        $data = [];
        $data['farmers']        =       Farmer::select('id', 'firstname', 'lastname')->get();
        $data['tags']           =       Tag::select('id')->without('created_at', 'updated_at')->get();
        $data['categories']     =       Category::select('id')->without('created_at', 'updated_at')->get();
        return view('livewire.front.farmer.farmer-add-product-component',$data)->layout('front.layouts.master2');
    }
}
