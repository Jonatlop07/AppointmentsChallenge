<?php

namespace App\Providers;

use App\Repositories\AppointmentRepository;
use App\Repositories\Adapters\AppointmentRepositoryAdapter;


use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AppointmentRepository::class, AppointmentRepositoryAdapter::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
