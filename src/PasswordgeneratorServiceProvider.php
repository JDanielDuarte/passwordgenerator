<?php

namespace Jdanielduarte\Passwordgenerator;

use Illuminate\Support\ServiceProvider;


class PasswordgeneratorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'passwordgenerator');

        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'passwordgenerator');

        $this->publishes([
            __DIR__ . '/resources/lang/pt' => resource_path('pt/jdanielduarte/passwordgenerator'),
        ]);

        $this->publishes([
            __DIR__ . '/assets' => public_path('css/jdanielduarte/passwordgenerator'),
        ], 'passwordgenerator');

        $this->loadMigrationsFrom(__DIR__ . '/migrations');

  }

  public function register()
  {

  }

}


 ?>
