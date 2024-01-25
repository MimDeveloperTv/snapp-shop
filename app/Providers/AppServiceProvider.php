<?php

namespace App\Providers;

use App\Services\Ghasedak\Ghasedak;
use App\Services\Service;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
      //  $this->app->bind(Service::class, Ghasedak::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
