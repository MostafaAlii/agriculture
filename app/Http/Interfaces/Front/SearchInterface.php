<?php
namespace App\Http\Interfaces\Front;
interface SearchInterface {
    public function search($id,$type);
    public function search_product($id,$type);
    public function search2($text);
}