<?php
namespace App\Http\Requests\Dashboard\Orders;
use Illuminate\Foundation\Http\FormRequest;
class OrderUpdateStatus extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            
        ];
    }

    public function messages() {
        return [

        ];
    }
}
