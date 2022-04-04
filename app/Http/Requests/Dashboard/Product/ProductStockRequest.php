<?php
namespace App\Http\Requests\Dashboard\Product;
use Illuminate\Foundation\Http\FormRequest;
class ProductStockRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'sku'                           =>          'sometimes|nullable|string|regex:/^[A-Za-z-أ-ي-pL\s\-0-9]+$/u',
            'manage_stock'                  =>          'required|in:1,0',
            'qty'                           =>          'required_if:manage_stock,==,1|min:1|numeric',
            'in_stock'                      =>          'required|in:0,1',
        ];
    }

    public function messages() {
        return [

        ];
    }
}
