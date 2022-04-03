<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class TreeTypeRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {

        return [

            'tree_type' => [
                'required',
                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u'

            ]
        ];
    }

    public function messages() {
        return [
            'tree_type.required'   => trans('Admin\validation.required'),
            'tree_type.regex'   => trans('Admin\validation.regex'),

        ];
    }
}
