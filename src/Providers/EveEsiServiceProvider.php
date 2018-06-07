<?php

namespace tenowg\EveSSO\Providers;

use Illuminate\Support\ServiceProvider;
use EveEsi\Character;

class EveEsiServiceProvider extends ServiceProvider
{
    public $bindings = [
        EveEsi\Character::class => EveEsi\Character::class,
    ];

    public $singletons = [
        EveEsi\Esi::class => EveEsi\Esi::class,
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__."/../config/eve-sso.php" => config_path('eve-sso.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__.'/../Migrations');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom( __DIR__.'/../config/eve-sso.php', 'eve-sso');
    }
}
