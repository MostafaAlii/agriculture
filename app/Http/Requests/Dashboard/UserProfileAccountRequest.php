<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class UserProfileAccountRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {
        $rules = [

            'firstname'    => 'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'lastname'     => 'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'phone'        => 'required_with:email|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:users',
            'email'        => 'required|email|unique:users',
            'password'     => 'required|confirmed|min:3|max:10',
            // "image"        => 'image|mimes:jpeg,png|max:4096',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $user = $this->route()->parameter('id');

            $rules['email'] = 'required|email|unique:users,id,' . $user;
            $rules['phone'] = 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:users,id,' . $user;
            $rules['password'] = 'confirmed';

        }//end of if

        return $rules;

    }//end of rules

    public function messages() {
        return [
            'firstname.required'   => trans('Admin\validation.required'),
            'lastname.required'    => trans('Admin\validation.required'),
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
            'image.image'          => trans('Admin\validation.image'),
            'image.mimes'          => trans('Admin\validation.mimes'),

             'password.required' => trans('Admin\validation.required'),
            'password.confirmed' => trans('Admin\validation.confirmed'),
            'password.min' => trans('Admin\validation.min'),
            'password.max' => trans('Admin\validation.max'),
            'password_confirmation.required'=> trans('Admin\validation.required'),
            'password_confirmation.same'=> trans('Admin\validation.same'),
        ];
    }
}
