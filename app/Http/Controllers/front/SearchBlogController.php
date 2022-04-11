<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Front\SearchInterface;
// use App\Http\Requests\Front\SearchRequest;
class SearchBlogController extends Controller
{
    protected $Data;
    public function __construct(SearchInterface $Data) {
        $this->Data = $Data;
    }
      
    public function search($id,$type)
    {
        return $this->Data->search($id,$type);
    }
    
    public function search2($text)
    {
        return $this->Data->search2($text);
    }
}