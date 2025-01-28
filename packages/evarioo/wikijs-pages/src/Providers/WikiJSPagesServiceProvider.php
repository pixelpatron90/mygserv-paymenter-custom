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
        $this->loadViewsFrom(__DIR__ . '/../views', 'evarioo-wikijs');
        Livewire::component('evarioo-wikijs', SimpleListeWidget::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../views' => base_path('resources/views/evarioo/wikijs'),
            ], 'views');
            $this->publishes([
                __DIR__ . '/../config.php' => config_path('wikijs.php'),
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
        $this->mergeConfigFrom(__DIR__ . '/../config.php', 'evarioo-wikijs');
    }
}