<?php

namespace HogLog\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use HogLog\HogLogService;

class HogLogController extends BaseController
{
    private $service;

    public function __construct(HogLogService $service)
    {
        $this->service = $service;
        $this->service->shareLogs();
    }

    public function loglist()
    {
        return view('hoglog::loglist');
    }

    public function logfile($logfile)
    {
        if ($this->service->isValidLogfile($logfile)) {
            return view('hoglog::logfile')
                ->with('logfile', $logfile)
                ->with('logdata', $this->service->getLogContents($logfile));
        }
    }
}