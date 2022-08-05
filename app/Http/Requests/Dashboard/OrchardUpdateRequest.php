<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrchardUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'farmer_id' => [
                'required',
                'exists:farmers,id',
                Rule::unique('orchards')->where(function ($query) {
                    $query
//                        ->where('farmer_id', $this->farmer_id)
                        ->where('land_category_id', $this->land_category_id)
                        ->where('supported_side', $this->supported_side);
                })->ignore($this->id)
            ],



            'admin_id' => 'required|exists:admins,id',
            'area_id' => 'required|exists:areas,id',
            'state_id' => 'required|exists:states,id',
            'village_id' => 'required|exists:villages,id',

            'land_category_id' => 'required|exists:land_categories,id',
//            |unique:orchards,farmer_id,id'.$this->id,
            'tree_count_per_orchard' =>'required|numeric',
            'orchard_area' => 'required|numeric',
            'supported_side'=>'required|in:govermental,international_organizations,private',
            'unit_id'=>'required|exists:units,id',

        ];
    }

    public function messages()
    {
        return [
            'farmer_id.required' => trans('Admin/validation.required'),
            'farmer_id.unique' => trans('Admin/validation.unique'),

            'admin_id.required' => trans('Admin/validation.required'),
            'area_id.required' => trans('Admin/validation.required'),
            'state_id.required' => trans('Admin/validation.required'),
            'village_id.required' => trans('Admin/validation.required'),

            'farmer_id.exists' => trans('Admin/validation.exists'),
            'admin_id.exists' => trans('Admin/validation.exists'),
            'area_id.exists' => trans('Admin/validation.exists'),
            'state_id.exists' => trans('Admin/validation.exists'),
            'village_id.exists' => trans('Admin/validation.exists'),
            'unit_id.exists' => trans('Admin/validation.exists'),
            'tree_count_per_orchard' => trans('Admin/validation.required'),

            'land_category_id.required' => trans('Admin/validation.required'),
            'tree_count_per_orchard.required' => trans('Admin/validation.required'),
            'orchard_area.required' => trans('Admin/validation.required'),
            'supported_side.required' => trans('Admin/validation.required'),
            'unit_id.required' => trans('Admin/validation.required'),


        ];
    }
}