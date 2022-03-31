<?php
namespace App\Http\Requests\Dashboard\Product;
use Illuminate\Foundation\Http\FormRequest;
class GeneralRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' =>'required|string|max:100|regex:/^[A-Za-z-أ-ي-pL\s\-0-9]+$/u|unique:product_translations,name,' . $this->id,
            'description'    =>'sometimes|string|nullable|unique:product_translations,description,'  . $this->id,
            'categories'        =>      'required|array|min:1',
            'categories.*'      =>      'numeric|exists:categories,id',
            'tags'        =>      'sometimes|nullable|array',
            'tags.*'      =>      'numeric|exists:tags,id',
            'price' =>  'required|numeric|min:0|digits_between:1,12',
            'photo'        => 'image|mimes:jpeg,png,jpg|max:4096',
        ];
    }

    public function messages() {
        return [

        ];
    }
}
