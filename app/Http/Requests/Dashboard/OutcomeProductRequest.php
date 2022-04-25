<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class OutcomeProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [

//            'admin_id' => 'required|exists:admins,id',
            'area_id' => 'sometimes|nullable',
            'province_id' => 'sometimes|nullable',
            'country_id' => 'required|exists:countries,id',
            'unit_id'=>'required|exists:units,id',
            'admin_department_id' => 'required',
            'outcome_product_amount' =>'required|numeric',
            'outcome_product_price' =>'required|numeric',
            'outcome_product_date' => 'required|date',

            'whole_product_id'=> 'required|exists:whole_products,id',
            'currency_id'=>'required|exists:currencies,id',

        ];
    }

    public function messages()
    {
        return [
            'currency_id.required' => trans('Admin/validation.required'),

            'whole_product_id.required' => trans('Admin/validation.required'),
//            'admin_id.required' => trans('Admin/validation.required'),
//            'area_id.required' => trans('Admin/validation.required'),
//            'province_id.required' => trans('Admin/validation.required'),
            'country_id.required' => trans('Admin/validation.required'),
            'outcome_product_amount.required' => trans('Admin/validation.required'),
            'outcome_product_price.required' => trans('Admin/validation.required'),
            'outcome_product_date.required' => trans('Admin/validation.required'),
            'admin_department_id.required' => trans('Admin/validation.required'),
            'unit_id.required' => trans('Admin/validation.required'),


        ];
    }
}