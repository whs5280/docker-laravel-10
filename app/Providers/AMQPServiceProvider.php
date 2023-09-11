<?php

namespace App\Providers;

use App\Common\Components\RabbitMq;
use Illuminate\Support\ServiceProvider;

class AMQPServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(RabbitMq::class, function () {

            $rabbitMq = new RabbitMq();
            $rabbitMq->init();
            return $rabbitMq;

        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }

    /**
     * @return array|string[]
     */
    public function provides()
    {
        return [RabbitMq::class];
    }
}
