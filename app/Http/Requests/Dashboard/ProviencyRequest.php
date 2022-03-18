<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class ProviencyRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {
        $rules = [

            'name'    =>'required|min:3|string|regex:/^[A-Za-z]+$/i',
            'country_id'        => 'required_with:name|int',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            /*$farmer = $this->route()->parameter('id');

            $rules['email'] = 'required|email|unique:farmers,id,' . $farmer;
            $rules['phone'] = 'required_with:email|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:farmers,id,' . $farmer;
            $rules['password'] = '';*/

        }//end of if

        return $rules;

    }//end of rules

    public function messages() {
        return [

            'firstname.required'   => trans('Admin\validation.required'),
            'lastname.required'    => trans('Admin\validation.required'),
            'email.required'       => trans('Admin\validation.required'),
            'phone.required'       => trans('Admin\validation.required'),
        ];
    }
}
