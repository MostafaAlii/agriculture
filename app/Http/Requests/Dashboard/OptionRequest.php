<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class OptionRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
           // regex انه يقبل حروف عربى انجليزى و ارقام او رموز
            'name' =>'required|string|max:100|regex:/^[A-Za-z-أ-ي-pL\s\-0-9]+$/u|unique:option_translations,name,' . $this->id,
            'price' =>  'required|numeric|min:0|digits_between:1,12',
        ];
    }

    public function messages() {
        return [
            'name.required'   =>  trans('Admin/options.name_required'),
            'name.string'     =>  trans('Admin/options.name_string'),
            'name.unique'     =>  trans('Admin/validation.unique'),
            'name.regex'     =>  trans('Admin/validation.regex'),
        ];
    }
}
