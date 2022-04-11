<?php
namespace App\Http\Requests\Front;
use Illuminate\Foundation\Http\FormRequest;
class RatingRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'id'   => ['required', 'int'],
        ];
    }

    public function messages() {
        return [

        ];
    }
}
