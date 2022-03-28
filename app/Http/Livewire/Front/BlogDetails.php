<?php

namespace App\Http\Livewire\Front;

use App\Models\Blog;
use Livewire\Component;

class BlogDetails extends Component
{

    public $blog_id;
    public function mount($blog_id){
        $this->blog_id = $blog_id;
    }
    public function render()
    {
        $blog = Blog::findorfail($this->blog_id);
        return view('livewire.front.blog-details',compact('blog'))->layout('front.layouts.master3');
    }
}
