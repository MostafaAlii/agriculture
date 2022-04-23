<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FarmerProfileRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {
        $rules = [

            'firstname'    => 'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'lastname'     => 'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'phone'        => 'required_with:email|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:farmers',
            // 'email'        => 'required|email|unique:farmers',
            'birthdate'       => 'before:today',
            'country_id'      => 'required',
            'province_id'     => 'required',
            'area_id'         => 'required',
            'state_id'        => 'required',
            'village_id'      => 'required',
            'department_id'   => 'required',
            'address1'        => 'required|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'address2'        => 'required|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',

        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            // $farmer = $this->route()->parameter('id');

            // $rules['email'] = 'required|email|unique:admins,id,' . $admin;
            $rules['phone'] = 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:farmers,id,' . Auth::user()->id;
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


            'country_id.required'    => trans('Admin\validation.required'),
            'province_id.required'   => trans('Admin\validation.required'),
            'area_id.required'       => trans('Admin\validation.required'),
            'state_id.required'      => trans('Admin\validation.required'),
            'village_id.required'    => trans('Admin\validation.required'),
            'department_id.required' => trans('Admin\validation.required'),
            'address1.required'      => trans('Admin\validation.required'),
            'address2.required'      => trans('Admin\validation.required'),

            'address1.regex'         => trans('Admin\validation.regex'),
            'address2.regex'         => trans('Admin\validation.regex'),

        ];
    }
}
