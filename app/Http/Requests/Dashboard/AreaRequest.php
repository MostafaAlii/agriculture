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
                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u'

            ],
            'location_x' =>  'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'location_y' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'province_id' => 'required',


        ];
    }

    public function messages() {
        return [
            'name.required'   => trans('Admin\validation.required'),
            'name.regex'   => trans('Admin\validation.regex'),
            'location_x.numeric'    => trans('Admin\validation.numeric'),
            'location_y.numeric'       => trans('Admin\validation.numeric'),
            'province_id.required'       => trans('Admin\validation.required'),

        ];
    }
}
