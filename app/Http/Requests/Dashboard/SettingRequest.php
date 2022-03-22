<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        return [
            'support_mail' => 'required|email',

            'primary_phone' => 'required|numeric',
            'secondery_phone' => 'required|numeric',
            'facebook' => 'required|url',
            'twitter' => 'required|url',
            'inestegram' => 'required|url',
            'site_name' => [
                'required',
                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u'
            ],


//            'site_logo' => image_validate(),
//            'site_icon' => image_validate(),
            'message_maintenance' => [
                'required',
                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u'
            ],
            'address' => [
                'required',
                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u'
            ],
        ];


    }

         public function messages()
    {
        return [
            'email.required' => trans('Admin/validation.required'),
            'email.email' => trans('Admin/validation.email'),

            'primary_phone.required' => trans('Admin/validation.required'),
            'secondery_phone.required' => trans('Admin/validation.required'),

            'facebook.required' => trans('Admin/validation.required'),
            'twitter.required' => trans('Admin/validation.required'),
            'inestegram.required' => trans('Admin/validation.required'),
            'facebook.url' => trans('Admin/validation.url'),
            'twitter.url' => trans('Admin/validation.url'),
            'inestegram.url' => trans('Admin/validation.url'),


            'site_name.required' => trans('Admin/validation.required'),
            'site_name.regex' => trans('Admin/validation.required'),
           'message_maintenance.required'=>trans('Admin/validation.required'),
            'message_maintenance.regex'=>trans('Admin/validation.regex'),
            'address.required'=>trans('Admin/validation.required'),
            'address.regex'=>trans('Admin/validation.regex'),
        ];
    }

}
