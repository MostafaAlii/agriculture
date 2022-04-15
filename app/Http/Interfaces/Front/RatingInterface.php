<?php
namespace App\Http\Interfaces\Front;
interface RatingInterface {
    public function storeProductRating($product_id,$rate);
    public function storeFarmerRating($farmer_id,$rate);
}