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
         //$blog = Blog::findorfail($this->blog_id)->withCount('comments')->dd();
        
        $comments = $blog->comments()->whereNull('parent_id')->orderby('id','desc')->get();/*->paginate(10)*/
        // $comments = $blog->comments()->whereNull('parent_id')->paginate(5);
        // in blog_detail blade ---->>>>>>  {{ $comments->links() }} 
        
        return view('livewire.front.blog-details',compact('blog','comments'))->layout('front.layouts.master3');
    }
}
