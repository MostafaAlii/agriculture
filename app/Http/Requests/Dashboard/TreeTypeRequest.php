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
//                'regex:/^[A-Za-z-أ-ي-pL\s\-\ء]+$/u',
                'unique:tree_type_translations,tree_type,tree_type_id'.$this->id,
                'string'


            ]
        ];
    }

    public function messages() {
        return [
            'tree_type.required'   => trans('Admin\validation.required'),
            'tree_type.string'   => trans('Admin\validation.regex'),
            'tree_type.unique'   => trans('Admin\validation.unique'),

        ];
    }
}
