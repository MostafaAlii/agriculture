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
            'qty'                 =>          ['numeric', new ProductStockQty($this->stock)],
        ];
    }

    public function messages() {
        return [
            'stock.required'                =>          trans('Admin/products.manage_stock_required'),
            'qty.numeric'                   =>          trans('Admin/products.qty_numeric'),

        ];
    }
}
