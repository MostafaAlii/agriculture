<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest {
    public function authorize() {
        return true;
    }


    public function rules() {
        return [
            'name' => [
            'required',
                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u'
            ],
//            'image'=>image_validate(),

        ];
    }

    public function messages() {
        return [
            'name.required'   =>  trans('Admin/validation.required'),
            'name.regex'     =>  trans('Admin/validation.regex'),
//            'image.required'=> trans('Admin/validation.required'),
        ];
    }
}
