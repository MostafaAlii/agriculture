<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class AreaRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {

        return [

            'name' => [
                'required',
//                'regex:/^[A-Za-z-أ-ي-pL\s\-\ء]+$/u',
                'unique:area_translations,name,area_id'.$this->id,
                'string'


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
            'name.string'   => trans('Admin\validation.string'),
            'name.unique'   => trans('Admin\validation.unique'),

            'location_x.numeric'    => trans('Admin\validation.numeric'),
            'location_y.numeric'       => trans('Admin\validation.numeric'),
            'province_id.required'       => trans('Admin\validation.required'),

        ];
    }
}
