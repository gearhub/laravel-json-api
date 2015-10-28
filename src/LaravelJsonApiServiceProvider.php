<?php

namespace VinceRuby\Tactician;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class LaravelJsonApiServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
	public function boot()
    {
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('jsonapi.php')
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
	public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/config.php', 'jsonapi');
    }
}