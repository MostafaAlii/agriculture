<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class LandCategoryRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {

        return [

            'category_name' => [
                'required',
                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u'

            ],
            'category_type' => [
                'required',
                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u'

            ]
        ];
    }

    public function messages() {
        return [
            'category_name.required'   => trans('Admin\validation.required'),
            'category_name.regex'   => trans('Admin\validation.regex'),
            'category_type.required'   => trans('Admin\validation.required'),
            'category_type.regex'   => trans('Admin\validation.regex'),

        ];
    }
}
