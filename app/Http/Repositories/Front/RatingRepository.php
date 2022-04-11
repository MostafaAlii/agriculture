<?php
namespace App\Http\Repositories\Front;
use App\Models\Farmer;
use App\Models\Rating;
use App\Models\Product;
//use Illuminate\Support\Facades\Auth;
use App\Http\Interfaces\Front\RatingInterface;
class RatingRepository implements RatingInterface {
    public function storeProductRating($request) {
        // web guard for farmers (as a Farmer) && vendor guard for vendors (as a User)
        $vendor = auth('vendor');
        //$vendor = Auth::user();
        return $vendor->ratedProducts;
        if($vendor){
            $vendor->ratedProducts()->syncWithoutDetacing($request->post('product_id'), [
                'rating'    =>  $request->post('rating'),
            ]);
            // return totaly rating for this product
            $product = Product::findOrFail($request->post('product_id'));
            $productSum = $product->ratings->sum(function($item){ // $item isrelated to the guardTable (User or Other)
                return $item->pivot->rating;
            });
            $avg = 100 * ($productSum / $product->ratings->count());
            return ['rating'    =>  $avg];
        }
    }

    /*public function storeFarmerRating($request) {
        // web guard for farmers (as a Farmer) && vendor guard for vendors (as a User)
        $vendor = Auth::user();
        if($vendor){
            $vendor->ratedFarmers()->syncWithoutDetacing($request->post('farmer_id'), [
                'rating'    =>  $request->post('rating'),
            ]);
            // return totaly rating for this farmer
            $farmer = Farmer::findOrFail($request->post('farmer_id'));
            $farmerSum = $farmer->ratings->sum(function($item){ // $item isrelated to the guardTable (User or Other)
                return $item->pivot->rating;
            });
            $avg = 100 * ($farmerSum / $farmer->ratings->count());
            return ['rating'    =>  $avg];
        }
    }*/
}