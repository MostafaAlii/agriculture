<?php

namespace App\Http\Livewire\Front;

use App\Models\Blog as ModelsBlog;
use Livewire\Component;

class Blog extends Component
{
    public function render()
    {
        $blogs = ModelsBlog::limit(6)->latest()->get();
        return view('livewire.front.blog',compact('blogs'))->layout('front.layouts.master3');
    }
}
