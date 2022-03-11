<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UserRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {
        $rules = [

            'firstname'    =>'required|min:3|max:100|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'lastname'     =>'required|min:3|max:100|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'phone'        => 'required|min:11|numeric|regex:/(0)[0-9]{9}/|unique:users',
            'email'        => 'required|email|unique:users',
            'password'     => 'required|confirmed|min:3|max:10',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $user = $this->route()->parameter('user');

            $rules['email'] = 'required|email|unique:users,id,' . $user->id;
            $rules['phone'] = 'required|min:11|numeric|regex:/(0)[0-9]{9}/|unique:users,id,' . $user->id;
            $rules['password'] = '';

        }//end of if

        return $rules;

    }//end of rules

    public function messages() {
        return [
            'firstname.required' => trans('validation.Admin.required'),
            'lasttname.required' => trans('validation.Admin.required'),
            'email.unique' => trans('validation.unique'),

        ];
    }
}
