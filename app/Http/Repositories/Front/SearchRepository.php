<?php
namespace  App\Http\Repositories\Front;
use App\Models\Blog;
use App\Models\Product;
use App\Traits\HasImage;
use App\Http\Interfaces\Front\SearchInterface;
class SearchRepository implements SearchInterface{
    use HasImage;
    //--------------------------------------------------------------------
    public function search($id,$type) {
        
        $model="App\\Models\\".$type;
        
        $d=$model::find($id);
        $new=array();
        foreach ($d->blogs as $blogs_id) {
           // echo $blogs_id->pivot->blog_id;
            array_push($new,$blogs_id->pivot->blog_id);
        }
     
        $data['blogs']= Blog::whereIn('id',$new)->get();
          
       return view('livewire.front.blog_search',$data);
       
    }
    //--------------------------------------------------------------------
    public function search_product($id,$type) {
        
        $model="App\\Models\\".$type;
       // echo $model;
        $d=$model::find($id);
        //dd($d->products);
        $new=array();
        foreach ($d->products as $products) {
            array_push($new,$products->pivot->product_id);
        }
   
        $data['products']= Product::whereIn('id',$new)->get();
           //dd($data['products']); 
       return view('livewire.front.product_search',$data);
       
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