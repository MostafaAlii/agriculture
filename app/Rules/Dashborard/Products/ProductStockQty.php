<?php
namespace App\Rules\Dashborard\Products;
use Illuminate\Contracts\Validation\Rule;
class ProductStockQty implements Rule {
    private $stock;
    public function __construct($stock) {
        $this->stock = $stock;
    }

    public function passes($attribute, $value) {
        if($this->stock == 1 && $value != null && $value != 0 && is_numeric($value)) {
            return true;
        }
        if($this->stock == 0 && $value == null) {
            return true;
        }
    }

    public function message() {
        return trans('Admin/products.qty_custom');
    }
}
