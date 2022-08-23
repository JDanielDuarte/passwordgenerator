<?php

namespace Jdanielduarte\Passwordgenerator\Classes;

class PasswordManager {

    private $size;                     // tamanho da password
    private $lower;
    private $upper;
    private $numbers;
    private $symbols;
    private $alphabet = "";                 // lista de caracteres a ser utilizados na geracao da password

    private $finalpass = "";                // password final gerada

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

    public function generatePassword() {                // Funcao de geracao da password

        $pass = array();
        $alphaLength = strlen($this->alphabet) - 1;

        while (!$pass) {                              // Ciclo onde e' gerada a password 
            for ($i = 0; $i < $this->size; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $this->alphabet[$n];
            }
            $this->finalpass = implode($pass);
            
            if (strpbrk($this->alphabet, "abcdefghijklmnopqrstuvwxyz")) {                   // E' feita a verificacao se sao cumpridos os requisitos corretos
              if (strpbrk($this->finalpass, "abcdefghijklmnopqrstuvwxyz") == False)         // Se nao for o caso, o array e colocado como vazio e e' criada uma nova
                $pass = array();
            }
        
            if (strpbrk($this->alphabet, "ABCDEFGHIJKLMNOPQRSTUVWXYZ")) {
              if (strpbrk($this->finalpass, "ABCDEFGHIJKLMNOPQRSTUVWXYZ") == False)
                $pass = array();
            }
        
            if (strpbrk($this->alphabet, "1234567890")) {
              if (strpbrk($this->finalpass, "1234567890") == False)
                $pass = array();
            }
        
            if (strpbrk($this->alphabet, "!?=-_#;.")) {
              if (strpbrk($this->finalpass, "!?=-_#;.") == False)
                $pass = array();
            }
        }

        return $this->finalpass;
    }

    public function encrypt() {                                         // Funcao de encriptacao da passe
        $hash = password_hash($this->finalpass, PASSWORD_DEFAULT);

        return $hash;
    }

    public function check() {
      if ($this->lower == 1 || $this->upper == 1)
        return "ok";
      else
        return -1;
    }

}