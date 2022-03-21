<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class BlogRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules()
    {
        $rules = [

            'title'    =>'required|min:3|string|regex:/^[A-Za-z]+$/i',
            'body'     =>'required|regex:/^[A-Za-z]+$/i',
            'admin_id' => 'required',
        ];
        return $rules;
    }
    public function messages() {
        return [
            'title.required'   => trans('Admin\validation.required'),
            'body.required'    => trans('Admin\validation.required'),
            'admin_id.required'=> trans('Admin\validation.required'),
            'title.min'        => trans('Admin\validation.min'),
            'title.regex'      => trans('Admin\validation.regex'),
            'body.regex'       => trans('Admin\validation.regex'),

        ];
    }
}
