<?php

namespace App\Http\Requests\Api\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'speciality_id' => 'required|integer|not_in:0',
            'city_id' => 'required|integer|not_in:0',
        ];
    }

    public function messages()
    {
       return [
            'name.required' => 'Имя не может быть пустым'
       ];
    }
}
