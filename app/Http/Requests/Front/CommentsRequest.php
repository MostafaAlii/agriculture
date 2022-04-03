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
            'author' => ['required', 'string', 'max:255'],
            'text'   => ['required', 'string', 'max:1000'],
        ];
    }

    public function messages() {
        return [
            'author.required'       => trans('Admin\validation.required'),            
            'author.max'            => trans('Admin\validation.max'),
            'author.string'         =>  trans('Admin/validation.string'),
            
            'text.required'         => trans('Admin\validation.required'),            
            'text.max'              => trans('Admin\validation.max'),
            'text.string'           =>  trans('Admin/validation.string'),

        ];
    }
}