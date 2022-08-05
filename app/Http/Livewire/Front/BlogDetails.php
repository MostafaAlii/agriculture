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
        $data['blog'] = Blog::findorfail($this->blog_id);
         //$blog = Blog::findorfail($this->blog_id)->withCount('comments')->dd();
        $data['comments'] = $data['blog']->comments()->whereNull('parent_id')->orderby('id','desc')->simplePaginate(5);
        $data['random_blogs']=Blog::inRandomOrder()->limit(2)->get();
        return view('livewire.front.blog-details',$data)->layout('front.layouts.master3');
    }
}
