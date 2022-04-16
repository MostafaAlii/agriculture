<?php
namespace App\Http\Repositories\Front;
use App\Models\Farmer;
use App\Models\Rating;
use App\Models\Product;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Interfaces\Front\RatingInterface;

class RatingRepository implements RatingInterface {
    
    public function storeProductRating($product_id,$rate) {
        //return $product_id;
        // web guard for farmers (as a Farmer) && vendor guard for vendors (as a User)
        $vendor = Auth::user();
        if($vendor){
            $vendor->ratedProducts()->syncWithoutDetaching( [$product_id=> ['rating'=>$rate]]);
            // return totaly rating for this product
            $product = Product::findOrFail($product_id);
            $avg=$product->ProductRate();
            return response()->json($avg); //then sent this data to ajax success
        }
        
    }

    public function storeFarmerRating($farmer_id,$rate) {
        // web guard for farmers (as a Farmer) && vendor guard for vendors (as a User)
        $vendor = Auth::user();
        if($vendor){
            $vendor->ratedFarmers()->syncWithoutDetaching([$farmer_id=> ['rating'    =>  $rate]]);
            // return totaly rating for this farmer
            $farmer = Farmer::findOrFail($farmer_id);
            $avg=$farmer->farmerRate();
            return response()->json($avg); //then sent this data to ajax success

        }
    }
}