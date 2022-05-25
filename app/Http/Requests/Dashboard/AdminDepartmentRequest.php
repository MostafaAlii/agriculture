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
            'name' => [
                'required',
                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u'
            ],


        ];


    }

    public function messages()
    {
        return [
            'name.required'  =>  trans('Admin/validation.required'),
            'name.regex'     =>  trans('Admin/validation.regex'),

        ];
    }

}
