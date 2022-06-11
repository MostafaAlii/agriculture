<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;


class FarmerRegisterRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {
        $rules = [
            'firstname'    =>'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'lastname'     =>'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'phone'        => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:farmers',
            'email'        => ['required', 'string', 'email', 'max:255', 'unique:farmers'],
            'password'     => ['required','confirmed','min:6','max:10'],
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
            'password.required'    => trans('Admin\validation.required'),
            'g-recaptcha-response.required' => trans('Admin\validation.required'),

            'firstname.min'        => trans('Admin\validation.min'),
            'lastname.min'         => trans('Admin\validation.min'),
            'phone.min'            => trans('Admin\validation.min'),
            'password.min'         => trans('Admin\validation.min'),

            'firstname.regex'      => trans('Admin\validation.regex'),
            'lastname.regex'       => trans('Admin\validation.regex'),
            'phone.regex'          => trans('Admin\validation.regex'),

            'email.email'          => trans('Admin\validation.email'),
            'email.unique'         => trans('Admin\validation.unique'),
            'phone.unique'         => trans('Admin\validation.unique'),
            'password.confirmed'   => trans('Admin\validation.confirmed'),
        ];
    }
}
