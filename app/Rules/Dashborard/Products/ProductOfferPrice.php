<?php
namespace App\Rules\Dashborard\Products;
use Illuminate\Contracts\Validation\Rule;
use App\Models\Product;
class ProductOfferPrice implements Rule {
    private $special_price;
    public function __construct($special_price) {
        $this->special_price = $special_price;
    }

    public function passes($attribute, $value) {
        $price = Product::getPrice()->get();
        if($this->special_price >= $price) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute should be less than main price';
    }
}
