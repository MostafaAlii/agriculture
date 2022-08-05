<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
class RolesRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ];
    }

    /*public function messages() {
        
    }*/
}
