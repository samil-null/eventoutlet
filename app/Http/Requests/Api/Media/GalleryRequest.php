<?php

namespace App\Http\Requests\Api\Media;

use App\Rules\UserCountImageRule;
use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
            'image' => ['mimes:jpeg,jpg,png','required', 'dimensions:min_width=800,min_height=800', 'max:500000', new UserCountImageRule(20)]
        ];
    }

    public function messages()
    {
        return [
            'image.mimes' => 'Не верный формат',
            'image.dimensions' => 'Неверные размер фото. Минимальные размер 1080x1080'
        ];
    }
}
