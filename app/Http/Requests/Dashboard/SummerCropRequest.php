<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class SummerCropRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {

        return [

            'name' => [
                'required',
//                'regex:/^[A-Za-z-أ-ي-pL\s\-\ء]+$/u',
                'string',
                'unique:summer_crop_translations,name,summer_crop_id'.$this->id,


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
