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

            'country_product_type' => 'required|in:local,iraq,imported',
            'area_id' => 'sometimes|nullable|exists:areas,id',
            'province_id' => 'sometimes|nullable|exists:provinces,id',
            'country_id' => 'required|exists:countries,id',
            'unit_id'=>'required|exists:units,id',
            'outcome_product_amount' =>'required|numeric',
            'outcome_product_price' =>'required|numeric',
            'outcome_product_date' => 'required|date',
            'admin_id' => 'required|exists:admins,id',

            'whole_product_id'=> 'required|exists:whole_products,id',
            'currency_id'=>'required|exists:currencies,id',

        ];
    }

    public function messages()
    {
        return [
            'currency_id.required' => trans('Admin/validation.required'),
            'whole_product_id.required' => trans('Admin/validation.required'),
            'country_product_type.required' => trans('Admin/validation.required'),
            'area_id.exists' => trans('Admin/validation.exists'),
            'province_id.exists' => trans('Admin/validation.exists'),
            'country_id.required' => trans('Admin/validation.required'),
            'outcome_product_amount.required' => trans('Admin/validation.required'),
            'outcome_product_price.required' => trans('Admin/validation.required'),
            'outcome_product_date.required' => trans('Admin/validation.required'),
            'unit_id.required' => trans('Admin/validation.required'),
            'unit_id.exists' => trans('Admin/validation.exists'),
            'currency_id.exists' => trans('Admin/validation.exists'),



        ];
    }
}