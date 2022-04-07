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
         'comment'   => ['required', 'string', 'max:1000','regex:/^[A-Za-z-أ-ي-pL\s\-0-9]+$/uu'],
        ];
    }

    public function messages() {
        return [
            'comment.required'         => trans('Website/comments.required'),            
            'comment.max'              => trans('Website/comments.max'),
            'comment.string'           => trans('Website/comments.string'),
            'comment.regex'            => trans('Website/comments.regex'),

        ];
    }
}