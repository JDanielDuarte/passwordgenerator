<?php

namespace Jdanielduarte\Passwordgenerator\Traits;

use Jdanielduarte\Passwordgenerator\Classes\PasswordManager;            // Generates a random password

trait PasswordTrait {

    public function passwordgenerate($size = 10, $lower = 1, $upper = 1, $numbers = 1, $symbols = 1) 
    {
        $params = [
            "size" => $size,
            "lower" => $lower,
            "upper" => $upper,
            "numbers" => $numbers,
            "symbols" => $symbols
        ];

        return (new PasswordManager($params))->generatepassword();
    }
}
