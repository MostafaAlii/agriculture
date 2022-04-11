<?php
namespace App\Http\Requests\Front;
use Illuminate\Foundation\Http\FormRequest;
class SearchRequest extends FormRequest {
    public function rules()
    {
        return [
         'search'   => ['required', 'string','regex:/^[A-Za-z-أ-ي-pL\s\-0-9]+$/uu'],
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