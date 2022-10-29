<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class CategoryRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name'           =>'required|string|unique:category_translations,name,' . $this->id,
            'parent_id'      =>'required',

            'department_id'     =>'required|exists:departments,id',

            'description'    =>'required',
            'keyword'        =>'required',
        ];
    }

    public function messages() {
        return [
            'name.required'             => trans('Admin\validation.required'),            
            'name.regex'                => trans('Admin\validation.regex'),
            'name.unique'               =>  trans('Admin/validation.unique'),
            'parent_id.required'        => trans('Admin\validation.required'),

            'department_id.required'    => trans('Admin\validation.required'),
            'department_id.exists'      => trans('Admin\validation.exists'),
        ];
    }
}