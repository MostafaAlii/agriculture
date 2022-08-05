<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class ProfileInformationRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {
        $rules = [
            'birthdate'       => 'date_format:Y-M-D|before:today',
            'country_id'      => 'required',
            'province_id'     => 'required',
            'area_id'         => 'required',
            'state_id'        => 'required',
            'village_id'      => 'required',
            'department_id'   => 'required',
            'address1'        => 'required',
            'address2'        => 'required',

        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $admin = $this->route()->parameter('id');

            // $rules['email'] = 'required|email|unique:admins,id,' . $admin;
            // $rules['phone'] = 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:admins,id,' . $admin;
            // $rules['type'] = 'required|in:admin,employee';
            // $rules['password'] = '';

        }//end of if

        return $rules;

    }//end of rules

    public function messages() {
        return [
            'country_id.required'    => trans('Admin\validation.required'),
            'province_id.required'   => trans('Admin\validation.required'),
            'area_id.required'       => trans('Admin\validation.required'),
            'state_id.required'      => trans('Admin\validation.required'),
            'village_id.required'    => trans('Admin\validation.required'),
            'department_id.required' => trans('Admin\validation.required'),
            'address1.required'      => trans('Admin\validation.required'),
            'address2.required'      => trans('Admin\validation.required'),

            'address1.regex'         => trans('Admin\validation.regex'),
            'address2.regex'         => trans('Admin\validation.regex'),

        ];
    }
}
