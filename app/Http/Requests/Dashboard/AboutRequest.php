<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class AboutRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' =>'required|string|min:3|max:100|regex:/^[A-Za-z-أ-ي-pL\s\-0-9]+$/u',
            'description' =>'required|string|min:3|max:1000',
        ];
    }

    public function messages() {
        return [
            'name.required'   =>  trans('Admin/validation.required'),
            'name.min'        =>  trans('Admin/validation.min'),
            'name.string'     =>  trans('Admin/validation.string'),
            'name.regex'      =>  trans('Admin/validation.regex'),

            'description.required'   =>  trans('Admin/validation.required'),
            'description.min'        =>  trans('Admin/validation.min'),
            'description.string'     =>  trans('Admin/validation.string'),
        ];
    }
}
