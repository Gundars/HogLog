<?php

namespace HogLog;

use Illuminate\Filesystem\Filesystem;
use Exception;

class HogLogServiceProvider
{
    protected $files;

    public function __construct($app)
    {
        $serviceProviders = [
            '',
            ''
        ];
        $this->registerServiceProviders($serviceProviders);
        $this->bootRoutes();
        $this->files = new Filesystem;
    }

    protected function bootConfiguration()
    {
        $this->package('gundars/hoglog');
    }

    protected function bootRoutes()
    {
        require __DIR__ . '/Http/routes.php';
    }

    protected function registerServiceProviders(array $providers = [])
    {
        if (count($providers) <= 0) {
            throw new Exception('Required paraemeter $providers is empty or missing');
        }

        foreach ($providers as $providerName) {
            $this->app->register($providerName);
        }
    }
}
