<?php

namespace App\Http\Requests\Dashboard;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Country;

class AdminDepartmentUpdateRequest extends FormRequest
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
//                'regex:/^[A-Za-z-أ-ي-pL\s\-\ء]+$/u',
            'string',

                'unique:admin_departments,id,'.$this->id,

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
