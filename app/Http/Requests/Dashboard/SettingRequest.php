<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {


        return [
            'support_mail' => 'sometimes|nullable|email',

            'primary_phone'         => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11',
            'secondery_phone' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11',
            'facebook' => 'required|url',
            'twitter' => 'required|url',
            'inestegram' => 'required|url',
            'site_name' => [
                'required',
                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',

            ],


            'ar_site_logo'=>'sometimes|nullable|mimes:png,jpg,jpeg',
            'en_site_logo'=>'sometimes|nullable|mimes:png,jpg,jpeg',

            'site_icon'=>'sometimes|nullable|mimes:png,jpg,jpeg',
            'message_maintenance' => [
                'required','string'
            ],
            'address' => [
                'required','string'
            ],
            'status'         => 'required|in:open,close',
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
