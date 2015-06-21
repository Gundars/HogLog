<?php

$uri = \Request::url();
$app = \App::getInstance();
$rootPrefix = config('hoglog.rootPrefix', '/hoglog/');

$app->group(
    [
        'prefix'    => $rootPrefix,
        'namespace' => 'HogLog\Http\Controllers'
    ],
    function ($app) {
        $app->get('/', 'HogLogController@loglist');
        $app->get('/log/{logfile}', 'HogLogController@logfile');
    }
);
