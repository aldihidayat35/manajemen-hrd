<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\DataApp;

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
        // Share global app data to all views with caching
        View::composer('*', function ($view) {
            $appData = Cache::remember('app_data_settings', 3600, function () {
                return DataApp::getInstance();
            });

            $view->with('appData', $appData);
        });
    }
}
