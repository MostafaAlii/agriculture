<?php

namespace App\Http\Livewire\Front;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination;

class Blogs extends Component
{
    use WithPagination;
    public function render()
    {

        $blogs = Blog::latest()->paginate(6);
        return view('livewire.front.blogs',compact('blogs'))->layout('front.layouts.master3');
    }
}
