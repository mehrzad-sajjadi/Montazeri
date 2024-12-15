<?php

namespace App\Providers;

use App\Models\Report;
use App\Policies\ReportPolicy;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
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
        Vite::prefetch(concurrency: 3);
        App::setLocale("fa");

        Gate::policy(Report::class ,ReportPolicy::class);

    }
}
