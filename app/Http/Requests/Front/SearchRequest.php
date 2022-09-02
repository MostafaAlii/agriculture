<?php
namespace App\Http\Requests\Front;
use Illuminate\Foundation\Http\FormRequest;
class SearchRequest extends FormRequest {
    public function rules()
    {
        return [
         'search'   => ['required', 'string'],
        ];
    }

    public function messages() {
        return [
            'search.required'         => trans('Website/comments.required'),
            'search.string'           => trans('Website/comments.string'),
            'search.regex'            => trans('Website/comments.regex'),

        ];
    }
}
