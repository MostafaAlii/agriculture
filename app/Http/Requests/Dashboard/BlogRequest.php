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

            'title'      => 'required|min:3|string|unique:blog_translations',
            'body'       => 'required|min:5|max:100',
            'admin_id'   => 'required',
            'categories' => 'required|exists:categories,id',
            'tags'       => 'required|exists:tags,id',
            // "image"    => 'image|mimes:jpeg,png|max:4096',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $blog = $this->route()->parameter('id');
            $rules['title'] = 'required|min:3|string|unique:blogs,id,' . $blog;
        }//end of if
        return $rules;
    }
    public function messages() {
        return [
            'title.required'   => trans('Admin\validation.required'),
            'title.unique'     => trans('Admin\validation.unique'),
            'body.required'    => trans('Admin\validation.required'),
            'admin_id.required'=> trans('Admin\validation.required'),
            'title.min'        => trans('Admin\validation.min'),
            'body.min'         => trans('Admin\validation.min'),
            'body.max'         => trans('Admin\validation.max'),
            'title.regex'      => trans('Admin\validation.regex'),
            'body.regex'       => trans('Admin\validation.regex'),
            'image.image'      => trans('Admin\validation.image'),
            'image.mimes'      => trans('Admin\validation.mimes'),

        ];
    }
}
