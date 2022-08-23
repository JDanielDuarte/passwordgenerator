# Password Generator

## Instalação Manual
* Download do software para a pasta vendor\\jdanidelduarte\\passwordgenerator
* Adicionar a seguinte linha ao ficheiro config\\app.php na secção providers
  * `Jdanielduarte\Passwordgenerator\PasswordgeneratorServiceProvider::class,`
* Acrescentar ficheiro composer.json
```
"autoload-dev": {
    "psr-4": {
        "Tests\\": "tests/",
        "Jdanielduarte\\Passwordgenerator\\": "vendor/jdanielduarte/passwordgenerator/src"
    }
},
```
* Executar `composer dump-autoload`
* Executr `php artisan migrate`