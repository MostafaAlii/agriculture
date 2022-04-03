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
//           'parent_id' => 'sometimes|nullable|numeric',
            'parent' => 'sometimes|nullable|exists:admin_departments,id',

            'keys' => 'sometimes|nullable|string',
            'desc' => 'sometimes|nullable|string',
            'name' => [
                'required',
                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u'
                        ],
            'image'=>'sometimes|nullable|image|mimes:png,jpg,jpeg',

        ];


    }

         public function messages()
    {
        return [
            'image.required' => trans('Admin/validation.required'),

                'name.required' => trans('Admin/validation.required'),
            'keys.required' => trans('Admin/validation.required'),

            'desc.required' => trans('Admin/validation.required'),

        ];
    }

}
