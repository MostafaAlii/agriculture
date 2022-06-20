<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class AreaUpdateRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {

        return [

            'name' => [
                'required',
                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
//                'unique:area_translations,name,area_id'.$this->id,
                'unique:areas,id,'.$this->id,



            ],
            'location_x' =>  'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'location_y' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'province_id' => 'required|exists:provinces,id',



        ];
    }

    public function messages() {
        return [
            'name.required'   => trans('Admin\validation.required'),
            'province_id.exists'   => trans('Admin\validation.exists'),
            'name.regex'   => trans('Admin\validation.regex'),
            'name.unique'   => trans('Admin\validation.unique'),

            'location_x.numeric'    => trans('Admin\validation.numeric'),
            'location_y.numeric'       => trans('Admin\validation.numeric'),
            'province_id.required'       => trans('Admin\validation.required'),

        ];
    }
}
