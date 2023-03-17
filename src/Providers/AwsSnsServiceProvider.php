<?php

namespace LootsIt\LaravelSns\Providers;

use Aws\Sns\MessageValidator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use LootsIt\LaravelSns\AwsCertClient;

class AwsSnsServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (config('aws_sns.cert_client.active'))
        {
            $this->app->singleton(MessageValidator::class, function (Application $app) {
                $awsCertClient = new AwsCertClient(
                    config('aws_sns.cert_client.cache_store'),
                    config('aws_sns.cert_client.cache_prefix')
                );
                return new MessageValidator($awsCertClient);
            });
        }
    }

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