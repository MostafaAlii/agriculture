<?php
namespace App\Http\Interfaces\Front;
interface RatingInterface {
    public function storeProductRating($request);
    public function storeFarmerRating($request);
}