<?php

namespace App\Rules;

use Auth;
use Illuminate\Contracts\Validation\Rule;

class UserCountImageRule implements Rule
{
    /**
     * @var int
     */
    protected $limit;

    /**
     * UserCountImageRule constructor.
     * @param int $limit
     */
    public function __construct(int $limit)
    {
        $this->limit = $limit;
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
        return Auth::user()->gallery()->count() < $this->limit;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Максимальное количество фото ' . $this->limit;
    }
}
