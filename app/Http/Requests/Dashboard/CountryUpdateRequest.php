<?php

namespace App\Http\Requests\Dashboard;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Country;

class CountryUpdateRequest extends FormRequest
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
//                'regex:/^[A-Za-z-أ-ي-pL\s\-\ء]+$/u',
                'unique:countries,id,' .$this->id,
                'string',

            ],
            'image' => 'sometimes|nullable|image|mimes:png,jpg,jpeg',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('Admin/validation.required'),
            'name.unique' => trans('Admin/validation.unique'),
            'name.string' => trans('Admin/validation.string'),
            'image.image' => trans('Admin/validation.image'),
        ];
    }
}
