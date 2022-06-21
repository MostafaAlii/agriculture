<?php
namespace App\Http\Requests\Dashboard\Product;
use Illuminate\Foundation\Http\FormRequest;
class ProductChangeStatusRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'status'         => 'sometime|nullable|in:0,1',
        ];
    }

    public function messages() {
        return [
            'status.required'          =>  trans('Admin/products.status_required'),
            'status.in'                =>  trans('Admin/products.status_in'),
        ];
    }
}
