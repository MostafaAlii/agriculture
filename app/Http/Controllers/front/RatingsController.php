<?php
namespace App\Http\Controllers\front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Front\RatingInterface;
use App\Http\Requests\Front\FarmerRatingRequest;
use App\Http\Requests\Front\ProductRatingRequest;
class RatingsController extends Controller {
    protected $Data;
    public function __construct(RatingInterface $Data) {
        $this->Data = $Data;
    }

    public function storeProductRating(ProductRatingRequest $request) {
        return $this->Data->storeProductRating($request);
    }

    public function storeFarmerRating(FarmerRatingRequest $request) {
        return $this->Data->storeFarmerRating($request);
    }
}
