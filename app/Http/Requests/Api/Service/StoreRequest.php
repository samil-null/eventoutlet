<?php

namespace App\Http\Requests\Api\Service;

use App\Rules\AdditionsFieldsRule;
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

        return [
            'name' => 'required|min:3|max:128',
            'price' => 'required|integer',
            'description' => 'required|max:500',
            'price_option_id' => 'required',
            'additional_fields' => [new AdditionsFieldsRule()]
        ];
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
