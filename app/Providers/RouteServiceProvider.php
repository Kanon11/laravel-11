<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register any application routes.
     *
     * Route registration is skipped when the application's routes are cached,
     * since the cached route file is loaded by the framework instead.
     */
    public function boot(): void
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));

        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }
}
