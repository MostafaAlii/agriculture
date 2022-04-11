<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class ProductCouponRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'code'              => 'required|unique:product_coupons|string|regex:/^[A-Za-z-أ-ي-pL\s\-0-9]+$/u',
                    'type'              => 'required|in:percentage,fixed',
                    'value'             => 'required|numeric',
                    'description'       => 'nullable',
                    'use_times'         => 'required|numeric',
                    'start_date'        => 'nullable|date_format:Y-m-d|after_or_equal:today',
                    'expire_date'       => 'required_with:start_date|date|date_format:Y-m-d|after:start_date',
                    'greater_than'      => 'nullable|numeric',
                    'status'            => 'required|in:0,1',
                    'user_id'           => 'required|exists:farmers,id',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'code'              => 'required|string|regex:/^[A-Za-z-أ-ي-pL\s\-0-9]+$/u|unique:product_coupons,code,'.$this->route()->parameter('id'),
                    'type'              => 'required|in:percentage,fixed',
                    'value'             => 'required|numeric',
                    'description'       => 'nullable',
                    'use_times'         => 'required|numeric',
                    'start_date'        => 'nullable|date_format:Y-m-d|after_or_equal:today',
                    'expire_date'       => 'required_with:start_date|date|date_format:Y-m-d|after:start_date',
                    'greater_than'      => 'nullable|numeric',
                    'status'            => 'required|in:0,1',
                    //'user_id'           => 'required|exists:farmers,id',
                ];
            }
            default: break;
        }
    }

    public function messages() {
        return [
            'code.required'             =>  trans('Admin/products.code_required'),
            'code.unique'               =>  trans('Admin/products.code_unique'),
            'code.regex'                =>  trans('Admin/products.code_regex'),

            'type.required'             =>  trans('Admin/products.type_required'),
            'type.in'                   =>  trans('Admin/validation.in'),
            
            'value.required'            =>  trans('Admin/validation.required'),
            'value.numeric'             =>  trans('Admin/validation.numeric'),
            'use_times.required'        =>  trans('Admin/validation.required'),
            'use_times.numeric'         =>  trans('Admin/validation.numeric'),

             'start_date.date_format'   =>  trans('Admin/validation.date_format'),
            'start_date.after_or_equal' =>  trans('Admin/validation.after_or_equal'),

            'expire_date.required_with' =>  trans('Admin/validation.required_with'),
            'expire_date.date'          =>  trans('Admin/validation.date'),
            'expire_date.date_format'   =>  trans('Admin/validation.date_format'),
            'expire_date.after'         =>  trans('Admin/validation.after'),
            
            'greater_than.numeric'      =>  trans('Admin/validation.numeric'),
            'status.required'           =>  trans('Admin/validation.required'),
            'status.in'                 =>  trans('Admin/validation.in'),
            'user_id.required'          =>  trans('Admin/validation.required'),
            'user_id.exists'            =>  trans('Admin/validation.exists'),
        ];
    }
}
