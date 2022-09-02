<?php
namespace App\Http\Requests\Front;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest {
    public function rules()
    {
        return [
         'name'         => ['required', 'string', 'max:100'],
         'email'        => ['required', 'email'],
         'message'      => ['required', 'string', 'max:1000'],
         'show_or_hide' => Rule::in(['0', '1']),
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

            'show_or_hide.in'       => trans('Admin/validation.in'),
        ];
    }
}
