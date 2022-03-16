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
//
            'primary_phone' => 'required|numeric',
            'secondery_phone' => 'required|numeric',
            'facebook' => 'required|url',
            'twitter' => 'required|url',
            'inestegram' => 'required|url',
            'site_name' => 'required|string',
            'site_logo' => image_validate(),
            'site_icon' => image_validate(),
            'status' => 'required|boolean',
            'message_maintenance' => 'required|string',
        ];


    }

         public function messages()
    {
        return [
            'email.required' => trans('Admin/setting.email_required'),
            'primary_phone.required' => trans('Admin/setting.primary_phone_required'),
            'secondery_phone.required' => trans('Admin/setting.secondery_phone_required'),

            'facebook.required' => trans('Admin/setting.facebook_required'),
            'twitter.required' => trans('Admin/setting.twitter_required'),
            'inestegram.required' => trans('Admin/setting.inestegram_required'),

            'site_name.required' => trans('Admin/setting.site_name_required'),
            'status.required' => trans('Admin/setting.status_required'),
           'message_maintenance.required'=>trans('Admin/setting.message_maintenance_required'),
        ];
    }

}
