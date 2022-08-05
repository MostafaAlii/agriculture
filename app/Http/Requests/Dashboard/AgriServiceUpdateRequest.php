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

//                'regex:/^[A-Za-z-أ-ي-pL\s\-\ء]+$/u',
            'string'

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
