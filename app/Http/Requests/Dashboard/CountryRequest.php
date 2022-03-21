<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest {
    public function authorize() {
        return true;
    }


    public function rules() {
        return [
            'name' => [
            'required',
            'regex:/^[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z]+[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z-_]+$/i'
            ],

        ];
    }

    public function messages() {
        return [
            'name.required'   =>  trans('Admin/countries.countries_name_required'),
            'name.string'     =>  trans('Admin/countries.countries_name_string'),
        ];
    }
}
