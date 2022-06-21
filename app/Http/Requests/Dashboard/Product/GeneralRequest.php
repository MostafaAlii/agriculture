<?php
namespace App\Http\Requests\Dashboard\Product;
use Illuminate\Foundation\Http\FormRequest;
class GeneralRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name'           =>'required|string|max:100|regex:/^[A-Za-z-أ-ي-pL\s\-0-9]+$/u|unique:product_translations,name,' . $this->id,
            'description'    =>'sometimes|string|nullable',
            'categories'     =>'required|array|min:1',
            'categories.*'   =>'numeric|exists:categories,id',
            'tags'           =>'sometimes|nullable|array',
            'tags.*'         =>'numeric|exists:tags,id',
            'price'          =>'required|numeric|min:1|digits_between:1,12',
            'photo'          =>'sometime|nullable|image|mimes:jpeg,png,jpg|max:4096',
            //'status'         => 'sometime|nullable|in:0,1',
        ];

    }

    public function messages() {
        return [
            'name.required'         =>  trans('Admin/products.name_required'),
            'name.max'              =>  trans('Admin/products.name_max'),
            'name.string'           =>  trans('Admin/products.name_string'),
            'name.unique'           =>  trans('Admin/products.name_unique'),
            'name.regex'            =>  trans('Admin/products.name_regex'),
            'description.regex'     =>  trans('Admin/products.desc_regex'),
            'categories.required'   =>  trans('Admin/products.category_required'),
            'tags.sometimes'         =>  trans('Admin/products.tag_required'),
            'price.required'        =>  trans('Admin/products.price_required'),
            'price.numeric'         =>  trans('Admin/products.price_numeric'),
            'price.min'             =>  trans('Admin/products.price_min'),
            'price.digits_between'  =>  trans('Admin/products.price_digits_between'),
            'photo.required'        =>  trans('Admin/products.photo_required'),
            'photo.image'           =>  trans('Admin/products.photo_image'),
            'status.required'       =>  trans('Admin/products.status_required'),
            'status.in'                =>  trans('Admin/products.status_in'),
        ];
    }
}
