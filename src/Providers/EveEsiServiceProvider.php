<?php

namespace tenowg\EveSSO\Providers;

use Illuminate\Support\ServiceProvider;
use EveEsi\Character;
use EveEsi\Contracts;
use EveEsi\Mail;

class EveEsiServiceProvider extends ServiceProvider
{
    public $bindings = [
        EveEsi\Character::class => EveEsi\Character::class,
        EveEsi\Contracts::class => EveEsi\Contracts::class,
        EveEsi\Mail::class => EveEsi\Mail::class,
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
