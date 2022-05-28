<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class IncomeProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'whole_product_id'=> 'required|exists:whole_products,id',
            'country_id' => 'required|exists:countries,id',
            'admin_id' => 'required|exists:admins,id',
            'unit_id'=>'required|exists:units,id',
            'currency_id'=>'required|exists:currencies,id',
            'income_product_amount' =>'required|numeric',
            'income_product_price' =>'required|numeric',
            'income_product_date' => 'required|date',
            'country_product_type'=>'required'


        ];
    }

    public function messages()
    {
        return [
            'currency_id.required' => trans('Admin/validation.required'),
            'whole_product_id.required' => trans('Admin/validation.required'),
            'admin_id.required' => trans('Admin/validation.required'),
            'country_product_type.required' => trans('Admin/validation.required'),
            'country_id.required' => trans('Admin/validation.required'),
            'income_product_amount.required' => trans('Admin/validation.required'),
            'income_product_price.required' => trans('Admin/validation.required'),
            'income_product_date.required' => trans('Admin/validation.required'),
            'unit_id.required' => trans('Admin/validation.required'),


        ];
    }
}