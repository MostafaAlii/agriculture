<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class AgriServiceUpdateRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {

        return [

            'name' => [
                'required',
                'unique:agri_services,id,'.$this->id,

                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',

            ],



        ];
    }

    public function messages() {
        return [
            'name.required'   => trans('Admin\validation.required'),
            'name.regex'   => trans('Admin\validation.regex'),
            'name.unique'   => trans('Admin\validation.unique'),


        ];
    }
}
