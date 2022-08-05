<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class WholesaleRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {

        return [

            'Name' => [
                'required',
                'string',
//                'regex:/^[A-Za-z-أ-ي-pL\s\-\ء]+$/u',
                'unique:wholesale_translations,Name,wholesale_id' . $this->id


        ]
        ];
    }

    public function messages() {
        return [
            'Name.required'   => trans('Admin\validation.required'),
            'Name.string'   => trans('Admin\validation.string'),
            'Name.unique'   => trans('Admin\validation.unique'),

            'unique:currency_translations,Name,currency_id'.$this->id,


        ];
    }
}
