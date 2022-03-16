<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class StateRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {

        return [
            'name' => 'required',
            'location_x' => 'required',
           'location_y' => 'required',
           'area_id' => 'required',
        ];


    }//end of rules

    public function messages() {
        return [
            'name.required'   => trans('Adminv\validation.required'),
            'location_x.required'    => trans('Admin\validation.required'),
            'location_y.required'       => trans('Admin\validation.required'),
             'area_id.required'       => trans('Admin\validation.required'),

        ];
    }
}
