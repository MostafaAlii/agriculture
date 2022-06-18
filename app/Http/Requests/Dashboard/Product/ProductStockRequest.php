<?php
namespace App\Http\Requests\Dashboard\Product;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Dashborard\Products\ProductStockQty;
class ProductStockRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'stock'                      =>          'required|in:0,1',
            'qty'                        =>          'required_if:stock,==,1|min:1|numeric',
            //'qty'                        =>          [new ProductStockQty($this->stock)],
        ];
    }

    public function messages() {
        return [
            'sku.regex'                     =>          trans('Admin/products.sku_regex'),
            'stock.required'                =>          trans('Admin/products.manage_stock_required'),
            'qty.required_if'               =>          trans('Admin/products.qty_required_for_available_stock'),
            'qty.numeric'                   =>          trans('Admin/products.qty_numeric'),
            'qty.min'                       =>          trans('Admin/products.qty_min'),

        ];
    }
}
