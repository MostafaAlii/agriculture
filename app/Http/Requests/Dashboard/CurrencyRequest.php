<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class CurrencyRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {

        return [

            'Name' => [
                'required',
                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u'

            ]
        ];
    }

    public function messages() {
        return [
            'Name.required'   => trans('Admin\validation.required'),
            'Name.regex'   => trans('Admin\validation.regex'),

        ];
    }
}
