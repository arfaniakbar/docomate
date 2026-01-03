<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        // Gunakan 'app.env' agar pengecekan lebih akurat sesuai config Laravel
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
    }
}