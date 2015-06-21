<?php

namespace HogLog;

use Illuminate\Support\ServiceProvider;
use HogLog\HogLogService;

Class HogLogServiceProvider extends ServiceProvider
{
    protected $app;

    public function __construct($app)
    {
        parent::__construct($app);

        $this->app = $app;
    }

    public function register()
    {
        $this->app->singleton('HogLogService', function ($app) {
            return new HogLogService($app);
        });
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'hoglog');
        $this->publishViews();
        $this->publishRoutes();
        //$serviceProviders = [];
        //$this->registerServiceProviders($app, $serviceProviders);
        //$this->files = new Filesystem;
    }

    public function publishViews()
    {
        return $this->publishes(
            [
                __DIR__ . '/resources/views' => base_path('resources/views/loglist'),
                __DIR__ . '/resources/views' => base_path('resources/views/logfile')
            ]
        );
    }

    public function publishRoutes()
    {
        return require __DIR__ . '/Http/routes.php';
    }

    public function publishAssets()
    {
        $this->publishes(
            [
                __DIR__ . '/path/to/assets' => public_path('vendor/gundars'),
            ],
            'public'
        );
    }

    protected function registerServiceProviders($app, array $providers = [])
    {
        if (count($providers) <= 0) {
            throw new Exception('Required parameter $providers is empty or missing');
        }

        foreach ($providers as $providerName) {
            $app->register($providerName);
        }
    }
}
