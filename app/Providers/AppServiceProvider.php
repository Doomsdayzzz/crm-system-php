<?php

namespace App\Providers;

use App\Models\Application;
use App\Observers\ApplicationObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any applications services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any applications services.
     */
    public function boot(): void
    {
        Application::observe(ApplicationObserver::class);
    }
}
