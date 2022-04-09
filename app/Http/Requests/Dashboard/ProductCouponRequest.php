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

        ];
    }
}
