<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;

class DisasterBeeUpdateRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {

        return [

            'name' => [
                'required',
                'unique:bee_disasters,id,'.$this->id,


            ],
            'desc'=>'required|string'
        ];
    }

    public function messages() {
        return [
            'name.required'   => trans('Admin\validation.required'),
            'name.unique'   => trans('Admin\validation.unique'),

            'desc.required'   => trans('Admin\validation.required'),


        ];
    }
}