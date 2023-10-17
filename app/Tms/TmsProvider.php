<?php

namespace App\Tms;

use App\Tms\Services\TmsService;
use Illuminate\Support\ServiceProvider;

class TmsProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('tms', function () {
            return new TmsService();
        });

        $this->app->alias('tms', TmsService::class);
    }

    public function boot()
    {
        $this->commands([
            \App\Tms\Commands\HandlerTms::class,
        ]);
    }
}
