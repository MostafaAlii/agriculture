<?php
namespace App\Http\Requests\Dashboard\Product;
use Illuminate\Foundation\Http\FormRequest;
class ProductPriceRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'special_price'                 =>          'required|numeric|min:1|digits_between:1,12',
            'special_price_type'            =>          'required_with:special_price|in:precent,fixed',
            'special_price_start'           =>          'required_with:special_price|date|date_format:Y-m-d',
            'special_price_end'             =>          'required_with:special_price|date|date_format:Y-m-d|after:special_price_start',
        ];
    }

    public function messages() {
        return [

        ];
    }
}
