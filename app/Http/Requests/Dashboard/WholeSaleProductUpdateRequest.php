<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class WholeSaleProductUpdateRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {

        return [

            'name' => [
                'required',
                'string',
//                'regex:/^[A-Za-z-أ-ي-pL\s\-\ء]+$/u',
                'unique:whole_products,id,'.$this->id,


            ],

        ];
    }

    public function messages() {
        return [
            'name.required'   => trans('Admin\validation.required'),
            'name.string'   => trans('Admin\validation.string'),
            'name.unique'   => trans('Admin\validation.unique'),

        ];
    }
}
