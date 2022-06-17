<?php
namespace App\Http\Requests\Dashboard\Product;
use Illuminate\Foundation\Http\FormRequest;
class ProductStockRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'stock'                      =>          'required|in:0,1',
            'qty'                           =>          'required_if:stock,==,1|min:0|numeric',
        ];
    }

    public function messages() {
        return [
            'sku.unique'                    =>  trans('Admin/products.sku_unique'),
            'sku.regex'                     =>  trans('Admin/products.sku_regex'),
            'manage_stock.required'         =>  trans('Admin/products.manage_stock_required'),
            'in_stock.required'             =>  trans('Admin/products.in_stock_required'),

        ];
    }
}
