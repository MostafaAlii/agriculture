<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class TeamRequest extends FormRequest {
    public function rules()
    {
        return [
         'name'   => ['required', 'string', 'max:100'],
         'position'   => ['required', 'string', 'max:100'],
         'description'   => ['required', 'string'],
        //  'image'         =>'image|mimes:jpg,png,jpeg|dimensions:max_width=600,max_height=600',
         'image'         =>'image|mimes:jpg,png,jpeg',

        ];
    }

    public function messages() {
        return [
            'name.required'         => trans('Admin/validation.required'),
            'name.max'              => trans('Admin/validation.max'),
            'name.string'           => trans('Admin/validation.string'),
            'name.regex'            => trans('Admin/validation.regex'),

            'position.required'         => trans('Admin/validation.required'),
            'position.max'              => trans('Admin/validation.max'),
            'position.string'           => trans('Admin/validation.string'),
            'position.regex'            => trans('Admin/validation.regex'),


            'description.required'      => trans('Admin/validation.required'),
            'description.max'           => trans('Admin/validation.max'),
            'description.string'        => trans('Admin/validation.string'),

            'image.image'               =>  trans('Admin/validation.image'),
            'image.mimes'               =>  trans('Admin/validation.mimes'),
            'image.dimensions'          =>  trans('Admin/validation.dimensions'),
        ];
    }
}
