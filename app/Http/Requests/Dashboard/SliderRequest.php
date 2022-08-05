<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class SliderRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        $rules = [

            'title'    =>'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u|unique:slider_translations',
            'subtitle' =>'required|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u|min:5|max:100',

        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $slider = $this->route()->parameter('id');
            $rules['title'] = 'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u|unique:sliders,id,' . $slider;
        }//end of if
        return $rules;
    }

    public function messages() {
        return [
            'title.required'       => trans('Admin\validation.required'),
            'title.unique'         => trans('Admin\validation.unique'),
            'subtitle.required'    => trans('Admin\validation.required'),
            'title.min'            => trans('Admin\validation.min'),
            'subtitle.min'         => trans('Admin\validation.min'),
            'subtitle.max'         => trans('Admin\validation.max'),
            'title.regex'          => trans('Admin\validation.regex'),
            'subtitle.regex'       => trans('Admin\validation.regex'),
            'image.image'          => trans('Admin\validation.image'),
            'image.mimes'          => trans('Admin\validation.mimes'),
        ];
    }
}
