<?php

namespace App\Http\Livewire\Front;

use App\Models\Blog;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;

class BlogDetails extends Component
{

    public $blog_id;
    public function mount($blog_id){
        $this->blog_id = Crypt::decrypt($blog_id);
    }
    public function render()
    {
        $blog = Blog::findorfail($this->blog_id);
         //$blog = Blog::findorfail($this->blog_id)->withCount('comments')->dd();
         $comments = $blog->comments()->whereNull('parent_id')->orderby('id','desc')->simplePaginate(6);
        // in blog_detail blade ---->>>>>>  {{ $comments->links() }}
        //dd($comments->count());
        return view('livewire.front.blog-details',compact('blog','comments'))->layout('front.layouts.master3');
    }
}
