<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class UserRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {
        $rules = [

            'firstname'    =>'required|min:3|string|regex:/^[A-Za-z]+$/i',
            'lastname'     =>'required|min:3|string|regex:/^[A-Za-z]+$/i',
            'phone'        => 'required_with:email|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:users',
            'email'        => 'required|email|unique:users',
            'password'     => 'required|confirmed|min:3|max:10',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $user = $this->route()->parameter('user');

            $rules['email'] = 'required|email|unique:users,id,' . $user->id;
            $rules['phone'] = 'required_with:email|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:users,id,' . $user->id;
            $rules['password'] = '';

        }//end of if

        return $rules;

    }//end of rules

    public function messages() {
        return [
            'firstname.required'   => trans('Adminv\alidation.required'),
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
