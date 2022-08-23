<?php

namespace Jdanielduarte\Passwordgenerator\Controllers;

use Jdanielduarte\Passwordgenerator\Classes\PasswordManager;
use Jdanielduarte\Passwordgenerator\Models\PasswordsRegistadas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordsRegistadasController extends Controller
{

    public function generate(Request $request): float|int|string
    {

        $params = [
            "size" => $request->size,
            "lower" => $request->low,
            "upper" => $request->upp,
            "numbers" => $request->num,
            "symbols" => $request->symb
        ];

        $passwordmanager = new PasswordManager($params);

        if (!$passwordmanager->check()) {
            return "letterError";
        }


        $lastTime = $this->lastTime()->created_at ?? NULL;

        if ($lastTime && now()->diffInSeconds($lastTime) <= 10)
        {
            return (10 - now()->diffInSeconds($lastTime));

        }


        $pass = "";
        while (!$pass) {
            $pass = $passwordmanager->generatepassword();
            $hash = $passwordmanager->encrypt();
            if ($this->checkDuplicate($hash)) {              // Verifica se a password encriptada ja existe na base de dados, caso ja existir e' gerada uma nova
                $pass = "";
            }
        }


        $this->store($hash);         // Password encriptada guardada na base de dados  // try catch?

        return $pass;
    }


    public function store($hash)
    {
        $password = new PasswordsRegistadas;
        $password->password = $hash;
        if ($password->save()) {
            return true;
        }

        return false;
    }


    public function checkDuplicate($hash)
    {
        return PasswordsRegistadas::where('password', $hash)->first();

    }

    public function lastTime()
    {
        return PasswordsRegistadas::latest()->first();
    }

}
