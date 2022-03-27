<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class ProductRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return  [];

            /*$rules = [
                'name' =>'required|string|max:100|regex:/^[A-Za-z-أ-ي-pL\s\-0-9]+$/u|unique:product_translations,name,',
                'farmer_id' => 'required|exists:farmers,id',
                'country_id' => 'required|exists:countries,id',
                'province_id' => 'required|exists:provinces,id',
                'area_id' => 'required|exists:areas,id',
                'state_id' => 'required|exists:states,id',
                'village_id' => 'required|exists:villages,id',
                'description' => 'required|max:1000|regex:/^[A-Za-z-أ-ي-pL\s\-0-9]+$/u',
                'price' =>  'required|numeric|min:0|digits_between:1,12',
                'photo'        => 'image|mimes:jpeg,png|max:4096',
            ];*/

            /*if  (Method('POST')) {
           
            }
            /**/
       
    }

    public function messages() {
        return [

        ];
    }
}
