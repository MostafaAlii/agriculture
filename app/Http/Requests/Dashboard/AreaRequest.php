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
                'regex:/^[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z]+[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z-_]+$/i'
            ],
            'location_x' =>  'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'location_y' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'province_id' => 'required',


        ];
    }

    public function messages() {
        return [
            'name.required'   => trans('Admin\validation.required'),
            'location_x.numeric'    => trans('Admin\validation.numeric'),
            'location_y.numeric'       => trans('Admin\validation.numeric'),
            'province_id.required'       => trans('Admin\validation.required'),

        ];
    }
}
