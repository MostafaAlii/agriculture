<?php
namespace App\Http\Controllers\front;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Interfaces\Front\RatingInterface;
use App\Http\Requests\Front\FarmerRatingRequest;
use App\Http\Requests\Front\ProductRatingRequest;

class RatingsController extends Controller {
    protected $Data;
    public function __construct(RatingInterface $Data) {
        $this->Data = $Data;
    }

    //public function storeProductRating(ProductRatingRequest $request) {
    public function storeProductRating($product_id,$rate) {
        return $this->Data->storeProductRating($product_id,$rate); 
    }

    public function storeFarmerRating($farmer_id,$rate) {
        return $this->Data->storeFarmerRating($farmer_id,$rate);
    }
}
