<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class AdminDepartmentRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {


        return [
            'parent' => 'sometimes|nullable|exists:admin_departments,id|numeric',

            'keys' => 'sometimes|nullable|string',
            'desc' => 'sometimes|nullable|string',
            'dep_name_ar' => [
                'required',
                'string'
            ],
            'dep_name_en' => [
                'required',
                'string'
            ],

        ];


    }

    public function messages()
    {
        return [
            'dep_name_ar.required' => trans('Admin/validation.required'),
            'dep_name_en.required' => trans('Admin/validation.required'),

//            'keys.required' => trans('Admin/validation.required'),
//
//            'desc.required' => trans('Admin/validation.required'),

        ];
    }

}
