<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CourseBeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [

            'name' => [
                'required',
//                'regex:/^[A-Za-z-أ-ي-pL\s\-\ء]+$/u',
                'unique:course_bee_translations,name,course_bee_id' . $this->id,
                'string'


            ],
            'desc' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('Admin\validation.required'),
            'name.string' => trans('Admin\validation.string'),
            'desc.required' => trans('Admin\validation.required'),
            'name.unique' => trans('Admin\validation.unique'),


        ];
    }
}
