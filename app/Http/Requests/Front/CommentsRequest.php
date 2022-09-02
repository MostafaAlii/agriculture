<?php
namespace App\Http\Requests\Front;
use Illuminate\Foundation\Http\FormRequest;
class CommentsRequest extends FormRequest {
    public function rules()
    {
        return [
         'comment'   => ['required', 'string', 'max:1000'],
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
