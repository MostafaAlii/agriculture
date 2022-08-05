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
//                'regex:/^[A-Za-z-أ-ي-pL\s\-\ء]+$/u',
                'unique:unit_translations,Name,unit_id'.$this->id,
                'string'

            ]

        ];
    }

    public function messages() {
        return [
            'Name.required'   => trans('Admin\validation.required'),
            'Name.string'   => trans('Admin\validation.string'),
            'Name.unique'   => trans('Admin\validation.unique'),


        ];
    }
}
