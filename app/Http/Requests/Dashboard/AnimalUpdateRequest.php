<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AnimalUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'area_id'         => 'required|exists:areas,id',
            'state_id'        => 'required|exists:states,id',
            'admin_id'        => 'required|exists:admins,id',
            'farmer_id' => 'required|exists:farmers,id',
            'village_id' => 'required|exists:villages,id',
            'currency_id' => 'required|exists:currencies,id',
//            'project_name' => 'required|string|unique:caw_projects,farmer_id,marketing_side,type,id,'.$this->id,

            'project_name' => [
                'required',
//
                    Rule::unique('caw_projects')->where(function ($query) {
                        $query->where('farmer_id', $this->farmer_id)
                            ->where('type', $this->type)
                            ->where('marketing_side', $this->marketing_side);
                    })->ignore($this->id),

            'string'

            ],
            'hall_num' =>'required|numeric',
            'animal_count' =>'required|numeric',
            'food_source'=>'required|in:local,outer',
            'marketing_side'=>'required|in:private,govermental',
            'cost'=>'required|numeric',
            'type'         => 'required|in:caw,ship,fish',

        ];
    }

    public function messages()
    {
        return [
            'farmer_id.required' => trans('Admin/validation.required'),
            'farmer_id.exists' => trans('Admin/validation.exists'),
            'admin_id.exists' => trans('Admin/validation.exists'),
            'area_id.exists' => trans('Admin/validation.exists'),
            'state_id.exists' => trans('Admin/validation.exists'),
            'village_id.exists' => trans('Admin/validation.exists'),
            'currency_id.required' => trans('Admin/validation.required'),
            'currency_id.exists' => trans('Admin/validation.exists'),
            'village_id.required' => trans('Admin/validation.required'),
            'project_name.required' => trans('Admin/validation.required'),
            'project_name.string' => trans('Admin/validation.string'),
            'hall_num.required' => trans('Admin/validation.required'),
            'animal_count.required' => trans('Admin/validation.required'),
            'food_source.required' => trans('Admin/validation.required'),
            'marketing_side.required' => trans('Admin/validation.required'),
            'cost.required' => trans('Admin/validation.required'),
            'type.required' => trans('Admin/validation.required'),


        ];
    }
}