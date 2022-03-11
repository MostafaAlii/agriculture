<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class FarmerRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {
        $rules = [

            'firstname'    =>'required|min:3|max:100|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'lastname'     =>'required|min:3|max:100|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'phone'        => 'required|min:11|numeric|regex:/(0)[0-9]{9}/|unique:farmers',
            'email'        => 'required|email|unique:farmers',
            'password'     => 'required|confirmed|min:3|max:10',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $farmer = $this->route()->parameter('farmer');

            $rules['email'] = 'required|email|unique:farmers,id,' . $farmer->id;
            $rules['phone'] = 'required|min:11|numeric|regex:/(0)[0-9]{9}/|unique:farmers,id,' . $farmer->id;
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
