<?php
namespace App\Rules\Dashborard\Products;
use Illuminate\Contracts\Validation\Rule;
class ProductStockQty implements Rule {
    private $stock;
    public function __construct($stock) {
        $this->stock = $stock;
    }

    public function passes($attribute, $value) {
        if($this->stock == 1 && $value == 0 || $value == NULL) {
            return false;
        }
    }

    public function message() {
        return 'The validation error message.';
    }
}
