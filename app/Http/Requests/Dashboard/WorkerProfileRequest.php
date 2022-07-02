<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class WorkerProfileRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {
        $rules = [

            'firstname'       => 'required|min:3|string',
            'lastname'        => 'required|min:3|string',
            'phone'           => 'required_with:email|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:workers',
            'birthdate'       => 'before:today',
            'country_id'      => 'required',
            'province_id'     => 'required',
            'area_id'         => 'required',
            'state_id'        => 'required',
            'village_id'      => 'required',
            'address1'        => 'required',
            'address2'        => 'required',
            'desc'            => 'sometimes|string|nullable',
            'salary'          => 'in:perday,perhour',
            'work'            => 'in:alone,team',
            'daily_price'     => 'numeric|min:1',
            'hourly_price'    => 'numeric|min:1',

        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            // $worker = $this->route()->parameter('id');
            $rules['phone'] = 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:workers,id,' . Auth::guard('worker')->user()->id;
        }//end of if

        return $rules;

    }//end of rules

    public function messages() {
        return [
            'firstname.required'   => trans('Admin\validation.required'),
            'lastname.required'    => trans('Admin\validation.required'),
            'phone.required'       => trans('Admin\validation.required'),
            'firstname.min'        => trans('Admin\validation.min'),
            'lastname.min'         => trans('Admin\validation.min'),
            'phone.min'            => trans('Admin\validation.min'),

            'firstname.regex'      => trans('Admin\validation.regex'),
            'lastname.regex'       => trans('Admin\validation.regex'),
            'phone.regex'          => trans('Admin\validation.regex'),

            'email.email'          => trans('Admin\validation.email'),
            'email.unique'         => trans('Admin\validation.unique'),
            'phone.unique'         => trans('Admin\validation.unique'),
            'image.image'          => trans('Admin\validation.image'),
            'image.mimes'          => trans('Admin\validation.mimes'),


            'country_id.required'    => trans('Admin\validation.required'),
            'province_id.required'   => trans('Admin\validation.required'),
            'area_id.required'       => trans('Admin\validation.required'),
            'state_id.required'      => trans('Admin\validation.required'),
            'village_id.required'    => trans('Admin\validation.required'),
            'address1.required'      => trans('Admin\validation.required'),
            'address2.required'      => trans('Admin\validation.required'),

            'address1.regex'         => trans('Admin\validation.regex'),
            'address2.regex'         => trans('Admin\validation.regex'),

        ];
    }
}
