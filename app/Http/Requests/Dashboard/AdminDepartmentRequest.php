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
//                'regex:/^[A-Za-z-أ-ي-pL\s\-\ء]+$/u',
            'string',
                'unique:admin_departments,id'.$this->id,

            ],
            'dep_name_en' => [
                'required',
//                'regex:/^[A-Za-z-أ-ي-pL\s\-\ء]+$/u',
                'string',
                'unique:admin_departments,id'.$this->id,

            ],
            'dep_name_ku' => [
                'required',
//                'regex:/^[A-Za-z-أ-ي-pL\s\-\ء]+$/u',
                'string',
                'unique:admin_departments,id'.$this->id,

            ],


        ];


    }

    public function messages()
    {
        return [
            'name.required'  =>  trans('Admin/validation.required'),
            'name.string'     =>  trans('Admin/validation.string'),
            'name.unique'   => trans('Admin\validation.unique'),


        ];
    }

}
