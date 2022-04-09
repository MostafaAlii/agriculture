<?php
namespace  App\Http\Repositories\Front;
use App\Models\Blog;
use App\Http\Interfaces\Front\SearchInterface;
use App\Models\Tag;

class SearchRepository implements SearchInterface{
    public function tag_search($tag_id) {
      //  $real_id=decrypt($tag_id);
       // dd($tag_id);
     //  $t= Tag::find($tag_id)->blogs();
    //    $t= Tag::find($real_id);
    //    $t->blogs;
         $b=Blog::get();
    //     $b->tags()->where('tag_id',$tag_id)->dd();
        // Tag::blogs()->where('tag_id',$tag_id)->dd();
      // $blogs->tags->dd();
      return $b;
    }

}