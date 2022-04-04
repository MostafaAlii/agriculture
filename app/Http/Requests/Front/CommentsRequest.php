<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class CommentsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'email'],
            'comment'   => ['required', 'string', 'max:1000'],
        ];
    }

    public function messages() {
        return [
            // 'name.required'       => trans('Admin\validation.required'),            
            // 'name.max'            => trans('Admin\validation.max'),
            // 'name.string'         =>  trans('Admin/validation.string'),

            // 'email.required'       => trans('Admin\validation.required'),
            // 'email.email'       => trans('Admin\validation.email'),
            
            'comment.required'         => trans('Admin\validation.required'),            
            'comment.max'              => trans('Admin\validation.max'),
            'comment.string'           =>  trans('Admin/validation.string'),

        ];
    }
}