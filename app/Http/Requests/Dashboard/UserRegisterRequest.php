<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;


class UserRegisterRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {
        $rules = [
            'firstname'    =>'required|min:3|string|regex:/^[A-Za-z]+$/i',
            'lastname'     =>'required|min:3|string|regex:/^[A-Za-z]+$/i',
            'phone'        => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:users',
            'email'        => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'     => ['required','confirmed','min:6'],
            'g-recaptcha-response' => 'required|captcha'
        ];
        return $rules;

    }//end of rules

    public function messages()
    {
        return [
            'firstname.required'   => trans('Admin\validation.required'),
            'lastname.required'    => trans('Admin\validation.required'),
            'email.required'       => trans('Admin\validation.required'),
            'phone.required'       => trans('Admin\validation.required'),
            'g-recaptcha-response.required' => trans('Admin\validation.required'),

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
