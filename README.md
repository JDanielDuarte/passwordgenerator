# Password Generator

## Instalação Manual
* Download do software para a pasta vendor\\jdanielduarte\\passwordgenerator
* Adicionar a seguinte linha ao ficheiro config\\app.php na secção providers
  * `Jdanielduarte\Passwordgenerator\PasswordgeneratorServiceProvider::class,`
* Acrescentar no ficheiro composer.json:
```
"autoload-dev": {
    "psr-4": {
        "Tests\\": "tests/",
        "Jdanielduarte\\Passwordgenerator\\": "vendor/jdanielduarte/passwordgenerator/src"
    }
},
```
* Executar `composer dump-autoload`
* Executar `php artisan migrate`