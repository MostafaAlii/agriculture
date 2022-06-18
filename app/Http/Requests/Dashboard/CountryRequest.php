<?php

namespace App\Http\Requests\Dashboard;

use App\Models\CountryTranslation;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Country;

class CountryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {


        return [
            'name' => [
                'required',
                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
                'unique:country_translations,name,country_id' . $this->id],
            'image' => 'sometimes|nullable|image|mimes:png,jpg,jpeg',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('Admin/validation.required'),
            'name.unique' => trans('Admin/validation.unique'),
            'name.regex' => trans('Admin/validation.regex'),
            'image.image' => trans('Admin/validation.image'),
        ];
    }
}
