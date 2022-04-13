<?php

namespace App\Providers;

use App\Http\Services\MultiStep\PendingMultiStepRegistration;
use App\Http\Services\MultiStep\SessionStorage;
use App\Http\Services\MultiStep\StepStorage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class MultiStepServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(StepStorage::class, function () {
            return new SessionStorage(request());
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Route::macro('multistep', function ($uri, $controller) {
            return new PendingMultiStepRegistration(
                $uri, $controller
            );
        });
    }
}
