<?php

namespace App\Http\Controllers\front;

use App\Models\Blog;
use App\Models\Comment;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\CommentsRequest;
use App\Http\Interfaces\Front\CommentInterface;

class CommentsController extends Controller
{
    protected $Data;
    public function __construct(CommentInterface $Data) {
        $this->Data = $Data;
    }
    
     
    public function store_blog(Blog $blog, CommentsRequest $request)
    {
        return $this->Data->store_blog($blog,$request);
    }
    
    public function store_product(Product $product, CommentsRequest $request)
    {
        return $this->Data->store_product($product,$request);
    }

    public function destroy(Comment $comment)
    {
        return $this->Data->destroy($comment);
    }

    
}