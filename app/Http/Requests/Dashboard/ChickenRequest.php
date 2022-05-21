<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ChickenRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [

            'farmer_id' => 'required|exists:farmers,id',
            'admin_id' => 'required',
            'area_id' => 'required',
            'state_id' => 'required',
            'village_id' => 'required|exists:villages,id',

            'project_name' => [
                'required',
                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u'

            ],
            'hall_num' =>'required|numeric',

            'suse_source' =>'required',
            'food_source'=>'required',
            'marketing_side'=>'required',
            'cost'=>'required|numeric',
            'power'=>'required|string',
            'phone'=>'required',
            'email'=>'required',

        ];


    }

    public function messages()
    {
        return [
            'farmer_id.required' => trans('Admin/validation.required'),
            'village_id.required' => trans('Admin/validation.required'),
            'project_name.required' => trans('Admin/validation.required'),
            'hall_num.required' => trans('Admin/validation.required'),
            'animal_count.required' => trans('Admin/validation.required'),
            'food_source.required' => trans('Admin/validation.required'),
            'marketing_side.required' => trans('Admin/validation.required'),
            'cost.required' => trans('Admin/validation.required'),
            'power.required' => trans('Admin/validation.required'),
            'suse_source.required' => trans('Admin/validation.required'),
            'phone.required' => trans('Admin/validation.required'),
            'email.required' => trans('Admin/validation.required'),


        ];
    }
}