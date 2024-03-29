<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class LandCategoryUpdateRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {

        return [

            'category_name' => [
                'required',
                'string',
                'unique:land_category_translations,category_name,'.$this->id,
            ],
            'category_type' => [
                'required',
                'string',
                'In:agriculture,non_agriculture'

            ]
        ];
    }

    public function messages() {
        return [
            'category_name.required'   => trans('Admin\validation.required'),
            'category_name.string'   => trans('Admin\validation.string'),
            'category_type.required'   => trans('Admin\validation.required'),
            'category_type.regex'   => trans('Admin\validation.regex'),
            'category_name.unique'   => trans('Admin\validation.unique'),


        ];
    }
}
