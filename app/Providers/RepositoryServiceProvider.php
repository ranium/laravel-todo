<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Map of contracts and repos
     *
     * @var array
     */
    private $pairs = [
        \App\Repositories\Contracts\TodoRepositoryInterface::class => \App\Repositories\Eloquent\TodoRepository::class,
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->pairs as $interface => $class) {
            $matches = [];
            // Get the model name based on the repository interface name
            // and then inject the model into the repository object
            preg_match('/([a-zA-Z]+)RepositoryInterface/', $interface, $matches);
            $model = sprintf('\App\%s', $matches[1]);
            $this->app->bind($interface, function ($app) use ($model, $class) {
                return new $class(new $model);
            });
        }
    }
}
