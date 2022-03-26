<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

use App\Models\Country;
class DepartmentRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name'           =>'required|string|regex:/^[A-Za-z-أ-ي-pL\s\-0-9]+$/uu|unique:department_translations,name,' . $this->id,
            'parent_id'      =>'required',

           // 'country_id'     =>'required|in:Country::all()',
           // 'country_id'     =>'required|'. [new Enum(Country::class)],

            'country_id'     =>'required|exists:countries,id',
            'province_id'    =>'required|exists:provinces,id',
            'area_id'        =>'required|exists:areas,id',
            'state_id'       =>'sometimes|exists:states,id',
            'village_id'     =>'sometimes|exists:villages,id',

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

            'country_id.required'   => trans('Admin\validation.required'),
            'province_id.required'  => trans('Admin\validation.required'),
            'area_id.required'      => trans('Admin\validation.required'),
            // 'state_id.required'     => trans('Admin\validation.required'),
            // 'village_id.required'   => trans('Admin\validation.required'),

            'description.required'  => trans('Admin\validation.required'),
            'keyword.required'      => trans('Admin\validation.required'),
        ];
    }
}
