<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class AdminRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {
        $rules = [

            'firstname'    =>'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'lastname'     =>'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'phone'        => 'required_with:email|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:admins',
            'email'        => 'required|email|unique:admins',
            'password'     => 'required|confirmed|min:6|max:10',
            'type'         => 'required|in:admin,employee',
            'admin_department_id'=>'required|exists:admin_departments,id',
            'country_id'      => 'sometimes|nullable|exists:countries,id',
            'province_id'     => 'sometimes|nullable|exists:provinces,id',
            'area_id'         => 'required|exists:areas,id',
            'state_id'        => 'required|exists:states,id',
            'village_id'      => 'sometimes|nullable|exists:villages,id',
            // "image"        => 'image|mimes:jpeg,png|max:4096',
            'roles_name'     =>'required|array|min:1',
            'roles_name.*'   =>'exists:roles,name',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $admin = $this->route()->parameter('id');

            $rules['email'] = 'required|email|unique:admins,id,' . $admin;
            $rules['phone'] = 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:admins,id,' . $admin;
            $rules['type'] = 'required|in:admin,employee';
            $rules['password'] = '';

        }//end of if

        return $rules;

    }//end of rules

    public function messages() {
        return [
            'admin_department_id.required'   => trans('Admin\validation.required'),

            'firstname.required'   => trans('Admin\validation.required'),
            'lastname.required'    => trans('Admin\validation.required'),
            'email.required'       => trans('Admin\validation.required'),
            'phone.required'       => trans('Admin\validation.required'),
            'type.required'        => trans('Admin\validation.required'),
            'type.in'              => trans('Admin\validation.in'),

            'firstname.min'        => trans('Admin\validation.min'),
            'lastname.min'         => trans('Admin\validation.min'),
            'phone.min'            => trans('Admin\validation.min'),

            'firstname.regex'      => trans('Admin\validation.regex'),
            'lastname.regex'       => trans('Admin\validation.regex'),
            'phone.regex'          => trans('Admin\validation.regex'),

            'email.email'          => trans('Admin\validation.email'),
            'email.unique'         => trans('Admin\validation.unique'),
            'phone.unique'         => trans('Admin\validation.unique'),

            'image.image'          => trans('Admin\validation.image'),
            'image.mimes'          => trans('Admin\validation.mimes'),
        ];
    }
}
