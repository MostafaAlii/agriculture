<?php
namespace App\Http\Repositories\Front;
use App\Http\Interfaces\Front\RatingInterface;
use App\Models\Rating;
class RatingRepository implements RatingInterface {
    public function storeProductRating($request) {
        try {
            // web guard for farmers (as a Farmer) && vendor guard for vendors (as a User)

            if(auth('vendor')){

            }
            /*if(auth('farmer')){

            }*/
        } catch (\Exception $ex) {
            //throw $th;
        }
    }
}