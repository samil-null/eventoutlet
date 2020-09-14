<?php

namespace App\Http\Requests\Api\Subscriptions;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeRequest extends FormRequest
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
            'email' => 'required|email',
            'city_id'   => 'required|integer|min:1',
            'date'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.min'         => 'Минимальный длина :min',
            'email.max'         => 'Максимальная длина :max',
            'email.required'    => 'Заполните поле',
            'email.email'       => 'Неверный формат email',
            'date.required'     => 'Укажите дату',
            'city_id.required'  => 'Укажите город',
            'city_id.min'       => 'Укажите город'
        ];
    }
}
