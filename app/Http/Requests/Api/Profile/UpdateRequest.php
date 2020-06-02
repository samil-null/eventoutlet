<?php

namespace App\Http\Requests\Api\Profile;

use App\Rules\ExistAvatarRule;
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
            'name'          => 'required|max:255',
            'speciality_id' => 'required|integer|not_in:0',
            'city_id'       => 'required|integer|not_in:0',
            'about_me'      => 'required',
            'phone'         => 'required',
            'email'         => 'required',
            'avatar'        => ['required'],
            'services'      => 'required|min:1|integer',
            'gallery'       => 'required|min:5|integer'
        ];
    }

    public function messages()
    {
       return [
           'avatar.required'    => 'Загрузите аватар',
           'gallery.min'        => 'Укажите как минимум 5 фото',
            '*.required'        => 'Заполните поле',
            '*integer'          => 'Заполните поле',
            '*.not_in'          => 'Заполните поле'
       ];
    }
}
