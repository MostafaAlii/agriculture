<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class DepartmentRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name'           =>'required|string',
            'parent_id'      =>'required',
            'country_id'     =>'required',/*|in:country*/
            'state_id'       =>'required',/*|in:state*/
            'description'    =>'required',
            'keyword'        =>'required',
        ];
    }

    public function messages() {
        return [
            'name.required'         => trans('Admin\validation.required'),
            'parent_id.required'    => trans('Admin\validation.required'),
            'country_id.required'   => trans('Admin\validation.required'),
            'state_id.required'     => trans('Admin\validation.required'),
            'description.required'  => trans('Admin\validation.required'),
            'keyword.required'      => trans('Admin\validation.required'),
        ];
    }
}
