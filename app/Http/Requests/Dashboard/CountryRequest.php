<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;


class CountryRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {

        return [
            'mob' =>   'required|numeric|min:10',
            'name' => 'required|string|regex:/^[A-Za-z]*$/i',// inter only character
            'code' => 'required|numeric|min:3',
        ];


    }//end of rules

    public function messages() {
        return [
            'name.required'   => trans('Adminv\validation.required'),
            'mob.required'    => trans('Admin\validation.required'),
            'code.required'       => trans('Admin\validation.required'),

        ];
    }
}
