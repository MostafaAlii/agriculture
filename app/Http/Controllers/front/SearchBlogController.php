<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Front\SearchInterface;

class SearchBlogController extends Controller
{
    protected $Data;
    public function __construct(SearchInterface $Data) {
        $this->Data = $Data;
    }
      
    public function tag_search($tag_id)
    {
        return $this->Data->tag_search($tag_id);
    }
}