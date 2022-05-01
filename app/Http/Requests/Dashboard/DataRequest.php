<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class DataRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {
        $rules = [
            'email'        => 'required|email|unique:data',
        ];
        return $rules;
    }//end of rules

    public function messages() {
        return [
            'email.required'       => trans('Admin\validation.required'),
            'email.email'          => trans('Admin\validation.email'),
            'email.unique'         => trans('Admin\validation.unique'),
        ];
    }
}
