<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class ProviencyRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {
        $rules = [

            'name'    =>'required|min:3|string',
            'country_id'        => 'required_with:name|int',
        ];
        return $rules;

    }//end of rules

    public function messages() {
        return [

            'firstname.required'   => trans('Admin\validation.required'),
            'lastname.required'    => trans('Admin\validation.required'),
            'email.required'       => trans('Admin\validation.required'),
            'phone.required'       => trans('Admin\validation.required'),
        ];
    }
}
