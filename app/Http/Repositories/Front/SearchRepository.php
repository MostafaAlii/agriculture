<?php
namespace  App\Http\Repositories\Front;
use App\Models\Blog;
use App\Http\Interfaces\Front\SearchInterface;

class SearchRepository implements SearchInterface{

    //--------------------------------------------------------------------
    public function search($id,$type) {
        
        $model="App\\Models\\".$type;
        
        $d=$model::find($id);
        $result=$d->blogs();

        $new=array();
        foreach ($d->blogs as $blogs_id) {
           // echo $blogs_id->pivot->blog_id;
            array_push($new,$blogs_id->pivot->blog_id);
        }
     
        $data['blogs']= Blog::whereIn('id',$new)->get();
          
       return view('livewire.front.blog_search',$data);
       
    }

    //--------------------------------------------------------------------
    public function search2($text) {

        //blogs thats its title like search input or have tags like search input
        $blogs =Blog::whereHas('translations', function ($query)  use ($text) {
            $query->where('title','like','%'.$text.'%');
        })->orwhereHas('tags.translations', function ($query)  use ($text) {
                 $query->where('name','like','%'.$text.'%');
        })
        ->get();

        $data['blogs']= $blogs;
        
       return view('livewire.front.blog_search',$data);
       
    }
}