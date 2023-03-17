<?php

namespace LootsIt\LaravelSns\Providers;

use Illuminate\Support\ServiceProvider;

class AwsSnsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/aws_sns.php' => config_path('aws_sns.php'),
        ]);
    }
}