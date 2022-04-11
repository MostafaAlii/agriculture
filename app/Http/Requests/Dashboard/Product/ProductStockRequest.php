<?php
namespace App\Http\Requests\Dashboard\Product;
use Illuminate\Foundation\Http\FormRequest;
class ProductStockRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'sku'                           =>          'sometimes|nullable|string|regex:/^[A-Za-z-أ-ي-pL\s\-0-9]+$/u|unique:products,sku,' . $this->id,
            'manage_stock'                  =>          'required|in:1,0',
           // 'qty'                           =>          'required_if:manage_stock,==,1|min:1|numeric',
            'in_stock'                      =>          'required|in:0,1',
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
