<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// use Illuminate\Support\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //  Carbon::serializeUsing(function ($carbon) {
     //     return $carbon->format(DateTime::ISO8601);
     // });
    }
}
