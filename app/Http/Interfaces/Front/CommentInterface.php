<?php
namespace App\Http\Interfaces\Front;
interface CommentInterface {
    public function store_blog($blog,$request);
    public function store_product($product,$request);
    public function store_farmer($farmer,$request);
    public function destroy($comment);
}