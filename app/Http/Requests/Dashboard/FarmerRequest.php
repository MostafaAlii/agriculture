<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class FarmerRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {
        $rules = [

            'firstname'    =>'required|min:3|string',
            'lastname'     =>'required|min:3|string',
            'phone'        => 'required_with:email|string|min:10|max:11|unique:farmers',
            'email'        => 'required|email|unique:farmers',
            'password'     => 'required|confirmed|min:6|max:10',
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

            $farmer = $this->route()->parameter('id');

            $rules['email'] = 'required|email|unique:farmers,id,' . $farmer;
            $rules['phone'] = 'required_with:email|string|min:10|max:11|unique:farmers,id,' . $farmer;
            $rules['password'] = '';

        }//end of if

        return $rules;

    }//end of rules

    public function messages() {
        return [

            'firstname.required'   => trans('Admin\validation.required'),
            'lastname.required'    => trans('Admin\validation.required'),
            'email.required'       => trans('Admin\validation.required'),
            'phone.required'       => trans('Admin\validation.required'),

            'firstname.min'        => trans('Admin\validation.min'),
            'lastname.min'         => trans('Admin\validation.min'),
            'phone.min'            => trans('Admin\validation.min'),

            'firstname.regex'      => trans('Admin\validation.regex'),
            'lastname.regex'       => trans('Admin\validation.regex'),
            'phone.regex'          => trans('Admin\validation.regex'),

            'email.email'          => trans('Admin\validation.email'),
            'email.unique'         => trans('Admin\validation.unique'),
            'phone.unique'         => trans('Admin\validation.unique'),

        ];
    }
}