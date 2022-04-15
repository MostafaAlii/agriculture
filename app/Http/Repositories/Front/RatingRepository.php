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
            $vendor->ratedProducts()->syncWithoutDetaching( [$product_id=> ['rating'=>$rate]]
                
             );
             //return response()->json('done');
            // return totaly rating for this product
            $product = Product::findOrFail($product_id);
            $productSum = $product->ratings->sum(function($item){ // $item is related to the guardTable (User or Other)
                return $item->pivot->rating;
            });
            
            $avg = 10*($productSum / $product->ratings->count());
          //  return ['rating'    =>  $avg];
            return response()->json($avg); //then sent this data to ajax success
        }
        
    }

    public function storeFarmerRating($farmer_id,$rate) {
        // web guard for farmers (as a Farmer) && vendor guard for vendors (as a User)

        $vendor = Auth::user();
        if($vendor){
            $vendor->ratedFarmers()->syncWithoutDetaching(
                [
                    $farmer_id=> ['rating'    =>  $rate]
                ]
            );
            // return totaly rating for this farmer
            $farmer = Farmer::findOrFail($farmer_id);
            $farmerSum = $farmer->ratings->sum(function($item){ // $item isrelated to the guardTable (User or Other)
                return $item->pivot->rating;
            });
            $avg = 10*($farmerSum / $farmer->ratings->count());
            // return ['rating'    =>  $avg];
            return response()->json($avg); //then sent this data to ajax success

        }
    }
}