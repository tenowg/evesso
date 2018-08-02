<?php

namespace tenowg\EveSSO\Providers;

use Illuminate\Support\ServiceProvider;
use EveEsi\Character;
use EveEsi\Contracts;
use EveEsi\Mail;
use EveEso\Assets;

class EveEsiServiceProvider extends ServiceProvider
{
    public $bindings = [
        EveEsi\Character::class => EveEsi\Character::class,
        EveEsi\Contracts::class => EveEsi\Contracts::class,
        EveEsi\Mail::class => EveEsi\Mail::class,
        EveEsi\Contacts::class => EveEsi\Contacts::class,
        EveEsi\Assets::class => EveEsi\Assets::class,
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
        $this->loadViewsFrom(__DIR__.'/../Views', 'evesso');
        $this->publishes([
            __DIR__."/../Config/eve-sso.php" => config_path('eve-sso.php'),
            __DIR__."/../Views" => resource_path('views/vendor/evesso'),
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
        $this->mergeConfigFrom( __DIR__.'/../Config/eve-sso.php', 'eve-sso');
    }
}
