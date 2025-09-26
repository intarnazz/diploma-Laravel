<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */

    public function boot(): void
    {
        Filament::serving(function () {
            $path = request()->path();

            if (
                $path === 'admin/login'
                || $path === 'admin/logout'
                || $path === 'livewire/message/filament.core.auth.login'
                || str_starts_with($path, 'filament/assets')
            ) {
                return;
            }

            if (!auth()->check() || auth()->user()->role !== 'admin') {
                auth()->logout();
                abort(403);
            }
        });
    }
}
