<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class StateRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            //
        ];
    }

    public function messages() {
        return [

        ];
    }
}
