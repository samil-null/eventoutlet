<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class AdditionsFieldsRule implements Rule
{
    protected $fields;

    protected $errors = [];
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->fields = request()->user()->speciality->fields;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        if (count($value) === $this->fields->count()) {
            $requestFields = collect($value);

            foreach ($this->fields as $field) {

                if ($requestFields->contains('id', $field->id)) {

                    $rField = $requestFields->where('id', $field->id)->first();
                    if (empty($rField['value'])) {
                        $this->addError($field->id,'Данное поле обязательно для заполнения');
                    } else {
                        if (!is_numeric($rField['value'])) {
                            $this->addError($field->id, 'Значение должно быть числовым');
                        }
                    }
                } else {
                    $this->addError($field->id,'Данное поле обязательно для заполнения');
                }

            }

            if (count($this->errors) === 0) {
                return true;
            }
        }

        $this->errors[] = 'wtf!';
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return [$this->errors];
    }

    protected  function addError($fieldId, $message)
    {
        $this->errors[$fieldId] = [
            'message' => $message
        ];
    }
}
