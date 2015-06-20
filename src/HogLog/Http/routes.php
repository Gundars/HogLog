<?php

$uri = \Request::url();
$app = \App::getInstance();

//Prepend custom route f.i. to block on production; end with /
$rootPrefix = (!defined('HOGLOG_ROUTE_PREFIX')) ? 'hoglog/' : HOGLOG_ROUTE_PREFIX;
$baseDir    = (!defined('HOGLOG_BASE_DIR')) ? 'storage/logs' : HOGLOG_BASE_DIR;

$app->group(
    [
        'prefix'     => $rootPrefix,
        //'namespace'  => 'HogLog\Http\Controllers',
        'middleware' => ''
    ],
    function ($app) {
        $app->get('/', view('logList'));
        $app->get('/log/{logfile}', view('logFile'));
    }
);

