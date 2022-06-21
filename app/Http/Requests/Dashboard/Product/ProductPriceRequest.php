<?php
namespace App\Http\Requests\Dashboard\Product;
use Illuminate\Foundation\Http\FormRequest;
class ProductPriceRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'special_price'                 =>          'required', 'numeric', 'digits_between:1,12',
            'special_price_type'            =>          'required_with:special_price|in:precent,fixed',
            'special_price_start'           =>          'required_with:special_price|date|date_format:Y-m-d',
            'special_price_end'             =>          'required_with:special_price|date|date_format:Y-m-d|after:special_price_start',
        ];
    }

    public function messages() {
        return [

            'special_price.required'             =>  trans('Admin/products.price_required'),
            'special_price.numeric'              =>  trans('Admin/products.price_numeric'),
            'special_price.min'                  =>  trans('Admin/products.price_min'),
            'special_price.digits_between'       =>  trans('Admin/products.price_digits_between'),

            'special_price_type.required_with'   =>  trans('Admin/products.special_price_type'),

            'special_price_start.required_with'  =>  trans('Admin/products.special_price_start'),
            'special_price_start.date'           =>  trans('Admin/products.special_price_start_date'),

            'special_price_end.required_with'    =>  trans('Admin/products.special_price_end'),
            'special_price_end.date'             =>  trans('Admin/products.special_price_end_date'),
            'special_price_end.after'            =>  trans('Admin/products.special_price_end_after'),
        ];
    }
}
