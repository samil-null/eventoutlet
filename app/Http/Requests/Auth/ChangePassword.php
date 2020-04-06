<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassword extends FormRequest
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
            'password'  => 'min:6|max:255|required|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'email.unique'          => 'Email уже занят',
            'email.min'             => 'Минимальный длина :min',
            'email.max'             => 'Максимальная длина :max',
            'email.required'        => 'Заполните поле',
            'email.email'           => 'Неверный формат email',
            'password.min'          => 'Минимальный длина :min',
            'password.max'          => 'Максимальная длина :max',
            'password.required'     => 'Заполните поле',
            'password.confirmed'    => 'Пороли не совподают'
        ];
    }
}
