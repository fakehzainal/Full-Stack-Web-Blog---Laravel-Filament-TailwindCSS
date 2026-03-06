<?php

namespace App\Providers;

use App\Models\Kategori;
use Filament\Notifications\Livewire\DatabaseNotifications;
use Filament\Notifications\Livewire\Notifications;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Backward-compatible aliases for stale Livewire snapshots after Filament updates.
        Livewire::component('filament.auth.pages.login', \Filament\Auth\Pages\Login::class);
        Livewire::component('filament.livewire.notifications', Notifications::class);
        Livewire::component('filament.livewire.database-notifications', DatabaseNotifications::class);
        Livewire::component('app.filament.widgets.blog-stats-overview', \App\Filament\Widgets\BlogStatsOverview::class);

        View::composer('layouts.landing', function ($view): void {
            $navCategories = Kategori::query()
                ->orderBy('nama')
                ->limit(8)
                ->get(['id', 'nama']);

            $view->with('navCategories', $navCategories);
        });
    }
}
