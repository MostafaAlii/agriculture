<?php
namespace App\Http\Requests\Dashboard\Orders;
use Illuminate\Foundation\Http\FormRequest;
class OrderUpdateStatus extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'status'                      =>          'required|in:0,1,2,3,4,5,8',
            'reason'                      =>          'required_if:status,==,4',
        ];
    }

    public function messages() {
        return [
            'status.required' => trans('Admin/orders.status_required'),
            'status.in' => trans('Admin/orders.status_required_in'),
            'reason.required_if' => trans('Admin/orders.reason_required_for_reject_only'),
            ];
    }
}
