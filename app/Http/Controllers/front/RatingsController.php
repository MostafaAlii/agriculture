<?php
namespace App\Http\Controllers\front;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Front\RatingInterface;
use Illuminate\Http\Request;
class RatingsController extends Controller {
    protected $Data;
    public function __construct(RatingInterface $Data) {
        $this->Data = $Data;
    }

    public function storeProductRating(Request $request) {
        return $this->Data->storeProductRating($request);
    }
}
