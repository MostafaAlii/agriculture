<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class TagRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {
        $rules = [

            'name'    =>'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'status'    =>'required',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $tag= $this->route()->parameter('id');
            $rules['status'] = '';
        }//end of if
        return $rules;
    }
    public function messages() {
        return [
            'name.required'   => trans('Admin\validation.required'),
            'status.required'   => trans('Admin\validation.required'),
            'name.min'        => trans('Admin\validation.min'),
            'name.regex'      => trans('Admin\validation.regex'),
        ];
    }
}
