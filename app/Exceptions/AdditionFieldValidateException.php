<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class AdditionFieldValidateException extends Exception
{
    protected $code = 423;

    protected $errors;

    public function __construct($errors)
    {
        $this->errors = $errors;

        parent::__construct('');
    }

    public function render()
    {
        return response()->json([
            'errors' => $this->errors,
        ], $this->code);
    }
}
