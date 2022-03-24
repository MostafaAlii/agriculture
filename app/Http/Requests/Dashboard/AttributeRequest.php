<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class AttributeRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
           // regex انه يقبل حروف عربى انجليزى بس ميقبلش ارقام او رموز
            'name' =>'required|string|max:100|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u|unique:attribute_translations,name,' . $this->id
        ];
    }

    public function messages() {
        return [
            'name.required'   =>  trans('Admin/attributes.name_required'),
            'name.string'     =>  trans('Admin/attributes.name_string'),
            'name.unique'     =>  trans('Admin/validation.unique'),
            'name.regex'     =>  trans('Admin/validation.regex'),
        ];
    }
}
