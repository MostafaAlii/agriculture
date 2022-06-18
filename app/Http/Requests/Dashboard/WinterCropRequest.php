<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class WinterCropRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {

        return [

            'name' => [
                'required',
                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
                'unique:winter_crop_translations,name,winter_crop_id'.$this->id,


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
