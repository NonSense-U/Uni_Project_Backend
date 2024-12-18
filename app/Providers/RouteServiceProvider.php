<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Load the custom locations routes
        if (file_exists(base_path('routes/locations.php'))) {
            Route::middleware('web')
                ->group(base_path('routes/locations.php'));
        }
    }
}
