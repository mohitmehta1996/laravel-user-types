<?php

namespace Mohit\Usertype;

use Illuminate\Support\ServiceProvider;

class UsertypeProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $router = $this->app['router'];
        $this->app['router']->aliasMiddleware('authorize', 'mohit\usertype\Middlewares\CheckPermission');
        $this->loadMigrationsFrom(__DIR__.'/migrations');

        $this->loadViewsFrom(__DIR__.'/views', 'usertype');
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/mohit/usertype'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\CreateAdmin::class,
                Commands\CreateSuperAdmin::class
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->make('Hashcrypt\Dbexception\DbexceptionController');
    }
}
