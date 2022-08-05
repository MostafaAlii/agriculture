<?php
namespace App\Http\Requests\Front;
use Illuminate\Foundation\Http\FormRequest;
class ProductRatingRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'product_id'        =>          ['required', 'int', 'exists:products,id'],
            'rating'            =>          ['required', 'int', 'min:1', 'max:5']
        ];
    }

    public function messages() {
        return [

        ];
    }
}
