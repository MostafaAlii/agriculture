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
            'location_x' =>   'required|numeric',
            'name' => 'required|string|regex:/^[A-Za-z]*$/i',// inter only character
            'location_y' => 'required|numeric',
            'province_id' => 'required',
        ];



    }//end of rules

    public function messages() {
        return [
            'name.required'   => trans('Adminv\validation.required'),
            'location_x.required'    => trans('Admin\validation.required'),
            'location_y.required'       => trans('Admin\validation.required'),
            'province_id.required'       => trans('Admin\validation.required'),

        ];
    }
}
