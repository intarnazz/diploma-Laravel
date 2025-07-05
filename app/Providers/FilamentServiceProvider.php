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
            // Получаем текущий путь из запроса
            $path = request()->path();
//http://localhost:8000/livewire/message/filament.core.auth.login
            // Разрешаем доступ к странице логина Filament без проверки роли
            if ($path === 'admin/login'
                || $path === 'admin/logout'
                || $path === 'livewire/message/filament.core.auth.login'
            ) {
                return;
            }

            // Проверяем аутентификацию и роль для всех остальных страниц админки
            if (!auth()->check() || auth()->user()->role !== 'admin') {
                auth()->logout();
                abort(403);
            }
        });
    }

}
