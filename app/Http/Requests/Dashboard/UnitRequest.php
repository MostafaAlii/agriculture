<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class UnitRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {

        return [

            'Name' => [
                'required',
                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
                'unique:unit_translations,Name,unit_id'.$this->id,

            ]

        ];
    }

    public function messages() {
        return [
            'Name.required'   => trans('Admin\validation.required'),
            'Name.regex'   => trans('Admin\validation.regex'),
            'Name.unique'   => trans('Admin\validation.unique'),


        ];
    }
}
