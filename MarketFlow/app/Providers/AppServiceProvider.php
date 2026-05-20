<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

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
        Gate::before(function ($user, $ability) {
            return $user->hasRole('admin') ? true : null;
        });

        if (config('app.env') === 'production') {
        \URL::forceScheme('https');
        }

        \Livewire\Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle)->middleware('web');
        });

        \Livewire\Livewire::setScriptRoute(function ($handle) {
            return Route::get('/livewire/livewire.js', $handle)->middleware('web');
        });
    }
}
