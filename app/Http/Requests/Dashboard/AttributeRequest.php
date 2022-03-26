<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class AttributeRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' =>'required|string|min:3|max:100|regex:/^[A-Za-z-أ-ي-pL\s\-0-9]+$/u|unique:attribute_translations,name,' . $this->id
        ];
    }

    public function messages() {
        return [
            'name.required'   =>  trans('Admin/attributes.name_required'),
            'name.min'        =>  trans('Admin/attributes.name_min'),
            'name.string'     =>  trans('Admin/attributes.name_string'),
            'name.unique'     =>  trans('Admin/validation.unique'),
            'name.regex'     =>  trans('Admin/validation.regex'),
        ];
    }
}
