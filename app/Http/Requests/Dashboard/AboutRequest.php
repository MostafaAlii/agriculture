<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class AboutRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name'          =>'required|string|min:3|max:100',
            'description'   =>'required|string|min:3|max:1000',
            // 'image'         =>'image|mimes:jpg,png,jpeg|dimensions:max_width=600,max_height=500',
            'image'         =>'image|mimes:jpg,png,jpeg|max:2000',
        ];
    }

    public function messages() {
        return [
            'name.required'             =>  trans('Admin/validation.required'),
            'name.min'                  =>  trans('Admin/validation.min'),
            'name.string'               =>  trans('Admin/validation.string'),
            'name.regex'                =>  trans('Admin/validation.regex'),

            'description.required'      =>  trans('Admin/validation.required'),
            'description.min'           =>  trans('Admin/validation.min'),
            'description.string'        =>  trans('Admin/validation.string'),

            'image.image'               =>  trans('Admin/validation.image'),
            'image.mimes'               =>  trans('Admin/validation.mimes'),
            'image.dimensions'          =>  trans('Admin/validation.dimensions'),
        ];
    }
}
