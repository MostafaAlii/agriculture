<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class BrandRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        $rules = [

            'title'    =>'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u|unique:brand_translations',

        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $brand = $this->route()->parameter('id');
            $rules['title'] = 'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u|unique:brands,id,' . $brand;
        }//end of if
        return $rules;
    }

    public function messages() {
        return [
            'title.required'       => trans('Admin\validation.required'),
            'title.unique'         => trans('Admin\validation.unique'),
            'title.min'            => trans('Admin\validation.min'),
            'title.regex'          => trans('Admin\validation.regex'),
            'image.image'          => trans('Admin\validation.image'),
            'image.mimes'          => trans('Admin\validation.mimes'),
        ];
    }
}
