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

            'firstname'    =>'required|min:3|max:100',
            'lastname'     =>'required|min:3|max:100',
            'phone'        => 'required|min:11|numeric',
            'email'        => 'required|email|unique:users',
            'password'     => 'required|confirmed',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $user = $this->route()->parameter('user');

            $rules['email'] = 'required|email|unique:users,id,' . $user->id;
            $rules['password'] = '';

        }//end of if

        return $rules;

    }//end of rules

    public function messages() {
        return [
          

        ];
    }
}
