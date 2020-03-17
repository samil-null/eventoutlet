<?php

namespace App\Http\Requests\Admin\Speciality;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpecialityRequest extends FormRequest
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
            'name' => 'required',
            'status' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле "Название" не может быть пустым',
            'status.required' => 'Поле "Статус" не может быть пустым',
            'status.integer' => 'Некорректное значение поля "Статус"'
        ];
    }
}
