<?php

namespace App\Http\Requests\Api\Offer;

use Illuminate\Foundation\Http\FormRequest;

class StoreOffer extends FormRequest
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
            'service_id' => 'required|integer',
            'discount' => 'required|integer|min:10|max:70',
            'description' => 'required|max:500',
            'dates' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'service_id.*' => 'Выберете услугу',
            'discount.required' => 'Укажите размер скидки',
            'discount.min' => 'Минимальный размер скидки :min%',
            'discount.max' => 'Максимальный размер скидки :max%',
            'description.required' => 'Заполните описание спец. предложения'
        ];
    }
}
