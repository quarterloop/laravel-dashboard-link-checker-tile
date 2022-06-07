<?php

namespace Quarterloop\LinkCheckerTile;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Quarterloop\LinkCheckerTile\Commands\FetchLinkCheckerCommand;

class LinkCheckerTileServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchLinkCheckerCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/dashboard-link-checker-tile'),
        ], 'dashboard-link-checker-views');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dashboard-link-checker-tile');

        Livewire::component('link-checker-tile', LinkCheckerTileComponent::class);
        Livewire::component('link-checker-small-tile', LinkCheckerSmallTileComponent::class);
    }
}
