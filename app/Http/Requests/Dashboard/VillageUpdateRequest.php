<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class VillageUpdateRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {

        return [

            'name' => [
                'required',
//                'regex:/^[A-Za-z-أ-ي-pL\s\-\ء]+$/u',
                'unique:villages,id'.$this->id,
                'string'


            ],
            'location_x' =>  'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'location_y' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'state_id' => 'required|exists:states,id',


        ];
    }

    public function messages() {
        return [
            'name.required'   => trans('Admin\validation.required'),
            'name.string'   => trans('Admin\validation.string'),
            'location_x.numeric'    => trans('Admin\validation.numeric'),
            'location_y.numeric'       => trans('Admin\validation.numeric'),
            'state_id.required'       => trans('Admin\validation.required'),
            'name.unique'   => trans('Admin\validation.unique'),


        ];
    }
}
