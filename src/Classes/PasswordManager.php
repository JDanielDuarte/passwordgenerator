<?php

namespace Jdanielduarte\Passwordgenerator\Classes;

class PasswordManager {

    private mixed $size;                     // tamanho da password
    private mixed $lower;
    private mixed $upper;
    private mixed $numbers;
    private mixed $symbols;
    private string $alphabet = "";                 // lista de caracteres a ser utilizados na geracao da password

    private string $finalpass = "";                // password final gerada

    public function __construct($params) {

        $this->size = $params["size"];
        $this->lower = $params["lower"];
        $this->upper = $params["upper"];
        $this->numbers = $params["numbers"];
        $this->symbols = $params["symbols"];
        if ($this->lower) $this->alphabet .= "abcdefghijklmnopqrstuvwxyz";    // Verificacao dos valores das checkboxes e insercao dos caracteres correspondes ao "alphabeto"
        if ($this->upper) $this->alphabet .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        if ($this->numbers) $this->alphabet .= "1234567890";
        if ($this->symbols) $this->alphabet .= "!?=-_#;.";
    }

    /**
     * @return string
     */
    public function generatePassword(): string
    {                // Funcao de geracao da password

        $pass = array();
        $alphaLength = strlen($this->alphabet) - 1;

        while (!$pass) {                              // Ciclo onde e' gerada a password
            for ($i = 0; $i < $this->size; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $this->alphabet[$n];
            }
            $this->finalpass = implode($pass);

            if (strpbrk($this->alphabet, "abcdefghijklmnopqrstuvwxyz")) {                   // E' feita a verificacao se sao cumpridos os requisitos corretos
              if (!strpbrk($this->finalpass, "abcdefghijklmnopqrstuvwxyz"))         // Se nao for o caso, o array e colocado como vazio e e' criada uma nova
                $pass = array();
            }

            if (strpbrk($this->alphabet, "ABCDEFGHIJKLMNOPQRSTUVWXYZ")) {
              if (!strpbrk($this->finalpass, "ABCDEFGHIJKLMNOPQRSTUVWXYZ"))
                $pass = array();
            }

            if (strpbrk($this->alphabet, "1234567890")) {
              if (!strpbrk($this->finalpass, "1234567890"))
                $pass = array();
            }

            if (strpbrk($this->alphabet, "!?=-_#;.")) {
              if (!strpbrk($this->finalpass, "!?=-_#;."))
                $pass = array();
            }
        }

        return $this->finalpass;
    }

    /**
     * @return string
     */
    public function encrypt(): string
    {                                         // Funcao de encriptacao da passe
        return password_hash($this->finalpass, PASSWORD_DEFAULT);
    }

    /**
     * @return bool
     */
    public function check(): bool
    {
      if ($this->lower == 1 || $this->upper == 1)
        return true;
      else
        return false;
    }

}
