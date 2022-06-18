<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;

class DisasterBeeRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {

        return [

            'name' => [
                'required',
                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
                'unique:bee_disaster_translations,name,bee_disaster_id'.$this->id,


            ],
            'desc'=>'required|string'
        ];
    }

    public function messages() {
        return [
            'name.required'   => trans('Admin\validation.required'),
            'name.regex'   => trans('Admin\validation.regex'),
            'name.unique'   => trans('Admin\validation.unique'),

            'desc.required'   => trans('Admin\validation.required'),


        ];
    }
}
