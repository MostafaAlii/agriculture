<?php
namespace App\Http\Requests\Front;
use Illuminate\Foundation\Http\FormRequest;
class FarmerRatingRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'farmer_id'        =>          ['required', 'int', 'exists:farmers,id'],
            'rating'            =>          ['required', 'int', 'min:1', 'max:5']
        ];
    }

    public function messages() {
        return [

        ];
    }
}
