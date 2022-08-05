<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class TreeRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {

        return [

            'name' => [
                'required',
//                'regex:/^[A-Za-z-أ-ي-pL\s\-\ء]+$/u',
                'unique:tree_translations,name,tree_id'.$this->id,
                'string'


            ],
            'tree_type_id'=>'required|exists:tree_types,id'
        ];
    }

    public function messages() {
        return [
            'name.required'   => trans('Admin\validation.required'),
            'name.string'   => trans('Admin\validation.string'),
            'tree_type_id.required'   => trans('Admin\validation.required'),

            'tree_type_id.exists'   => trans('Admin\validation.exists'),
            'name.unique'   => trans('Admin\validation.unique'),


        ];
    }
}
