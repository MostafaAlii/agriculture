<?php
namespace App\Http\Requests\Front;
use Illuminate\Foundation\Http\FormRequest;
class ReviewRequest extends FormRequest {
    public function rules()
    {
        return [
         'name'   => ['required', 'string', 'max:100','regex:/^[A-Za-z-أ-ي-pL\s\-0-9]+$/uu'],
         'email'   => ['required', 'email'],
         'message'   => ['required', 'string', 'max:1000','regex:/^[A-Za-z-أ-ي-pL\s\-0-9]+$/uu'],
        ];
    }

    public function messages() {
        return [
            'name.required'         => trans('Admin/validation.required'),            
            'name.max'              => trans('Admin/validation.max'),
            'name.string'           => trans('Admin/validation.string'),
            'name.regex'            => trans('Admin/validation.regex'),
            
            'email.required'        => trans('Admin/validation.required'),            
            'email.email'           => trans('Admin/validation.email'),
            
            'message.required'      => trans('Admin/validation.required'),            
            'message.max'           => trans('Admin/validation.max'),
            'message.string'        => trans('Admin/validation.string'),
            'message.regex'         => trans('Admin/validation.regex'),
        ];
    }
}