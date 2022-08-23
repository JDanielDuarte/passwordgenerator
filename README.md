# Password Generator

## Um gerador de passwords aleatórias

# Instalação Manual
* Download do software para a pasta package\\passwordgenerator
* Adicionar a seguinte linha ao ficheiro config\\app.php na secção providers
  * `Jdanielduarte\Passwordgenerator\PasswordgeneratorServiceProvider::class,`
* Acrescentar ficheiro composer.json
```
"autoload-dev": {
    "psr-4": {
        "Tests\\": "tests/",
        "Jdanielduarte\\Passwordgenerator\\": "package/passwordgenerator/src"
    }
},
```
* Executar `composer dump-autoload`
* Acrescentar a permissão para ver o menu com a slug `allbs-catalogo`
* Atribuir a permissão as funções
