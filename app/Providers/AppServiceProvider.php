<?php

namespace App\Providers;

use App\Services;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            Services\PlaneSeatsMap\PlaneSeatsMap::class,
            Services\PlaneSeatsMap\Service::class
        );
        $this->app->bind(
            Services\Booking\Booking::class,
            Services\Booking\Service::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
