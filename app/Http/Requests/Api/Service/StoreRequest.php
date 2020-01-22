<?php

namespace App\Http\Requests\Api\Service;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        $rules = [
            'name' => 'required|min:3|max:128',
            'price' => 'required|integer',
            'description' => 'max:500',
            'price_option_id' => 'required'
        ];

        $fields = request()->user()->speciality->fields;

        foreach ($fields as $field) {
            $rules['additional_fields.' . $field->key . '.value'] = 'required|integer';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле Услуга обязательно',
            'name.min' => 'Название услуги сликом короткое, минимальная длинна :min',
            'additional_fields.*.required' =>  'Поле не может быть пустым',
            'additional_fields.*.integer' =>  'Значение должно быть числом',
        ];
    }
}
