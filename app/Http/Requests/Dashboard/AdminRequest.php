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

            'firstname'    =>'required|min:3|string|regex:/^[A-Za-z]+$/i',
            'lastname'     =>'required|min:3|string|regex:/^[A-Za-z]+$/i',
            'phone'        => 'required_with:email|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:admins',
            'email'        => 'required|email|unique:admins',
            'password'     => 'required|confirmed|min:3|max:10',
            'type'         => 'required|in:admin,employee',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $admin = $this->route()->parameter('id');

            $rules['email'] = 'required|email|unique:admins,id,' . $admin->id;
            $rules['phone'] = 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:admins,id,' . $admin->id;
            $rules['type'] = 'required|in:admin,employee';
            $rules['password'] = '';

        }//end of if

        return $rules;

    }//end of rules

    public function messages() {
        return [
            'firstname.required'   => trans('Adminv\validation.required'),
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
        ];
    }
}
