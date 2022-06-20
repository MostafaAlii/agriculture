<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class TreeUpdateRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {

        return [

            'name' => [
                'required',
                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
                'unique:trees,id,'.$this->id,



            ],
            'tree_type_id'=>'required|exists:tree_types,id'
        ];
    }

    public function messages() {
        return [
            'name.required'   => trans('Admin\validation.required'),
            'name.regex'   => trans('Admin\validation.regex'),
            'tree_type_id.required'   => trans('Admin\validation.required'),

            'tree_type_id.exists'   => trans('Admin\validation.exists'),
            'name.unique'   => trans('Admin\validation.unique'),


        ];
    }
}
