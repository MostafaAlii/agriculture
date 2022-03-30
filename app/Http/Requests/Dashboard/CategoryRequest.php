<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CategoryRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name'           =>'required|string|regex:/^[A-Za-z-أ-ي-pL\s\-0-9]+$/uu|unique:category_translations,name,' . $this->id,
            'parent_id'      =>'required',

            'department_id'     =>'required|exists:departments,id',

            'description'    =>'required|regex:/^[A-Za-z-أ-ي-pL\s\-0-9]+$/uu',
            'keyword'        =>'required',
        ];
    }

    public function messages() {
        return [
            'name.required'         => trans('Admin\validation.required'),            
            'name.regex'            => trans('Admin\validation.regex'),
            'name.unique'           =>  trans('Admin/validation.unique'),
            'parent_id.required'    => trans('Admin\validation.required'),

            'department_id.required'   => trans('Admin\validation.required'),
        ];
    }
}
