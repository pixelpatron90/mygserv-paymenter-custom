<?php
namespace Evarioo\WikiJSPages\Providers;

use Evarioo\WikiJSPages\Components\SimpleListeWidget;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class WikiJSPagesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //$this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'evarioo-wikijs');
        //$this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
        //$this->loadMigrationsFrom(__DIR__ . '/../migrations');
        $this->loadViewsFrom(__DIR__ . '/../views', 'evarioo-wikijs');
        Livewire::component('evarioo-wikijs', SimpleListeWidget::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../views' => base_path('resources/views/prakash/todolist'),
            ], 'views');
            $this->publishes([
                __DIR__ . '/../../config/config.php' => config_path('task.php'),
            ], 'config');
        }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Evarioo\WikiJSPages\Controllers\WikiJSPagesController');
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config.php', 'evarioo-wikijs');

        // Register the main class to use with the facade
        $this->app->singleton('task', function () {
            return new Task;
        });
        // $this->app->bind('task', function () {
        //     return new Task();
        // });
    }
}