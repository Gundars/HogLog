<?php

namespace HogLog;

use Illuminate\Filesystem\Filesystem;
use Exception;

class HogLogService
{
    protected $files;

    public function __construct($app)
    {
        //$serviceProviders = [
        //
        //];
        //$this->registerServiceProviders($app, $serviceProviders);
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
