<?php

namespace HogLog;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\View;

class HogLogService
{
    protected $files;
    protected $fileSystem;

    public function __construct()
    {
        $this->fileSystem = new Filesystem();
    }

    public function shareLogs()
    {
        $this->getLogPaths();
        $this->getFileInfo();
        $this->shareData($this->files);
    }

    public function isValidLogfile($logfile)
    {
        if (!array_key_exists($logfile, $this->files)) {
            throw new \Exception('Log ' . $logfile . ' not found');
        }
        return true;
    }

    public function getLogContents($logfile)
    {
        return $this->fileSystem->get($this->files[$logfile]['path']);
    }

    protected function getLogDir()
    {
        return config('hoglog.logdir', storage_path() . '/logs');
    }

    protected function getLogPaths()
    {
        $this->files = $this->fileSystem->files($this->getLogDir());
        if (count($this->files) === 0) {
            throw new \Exception('No log files available in ' . $this->getLogDir());
        }

        return $this->files;
    }

    protected function getFileInfo()
    {
        foreach ($this->files as $key => $path) {
            if (!$this->fileSystem->exists($path)) {
                continue;
            }
            $name = $this->fileSystem->name($path) . '.' . $this->fileSystem->extension($path);
            $size = $this->fileSystem->size($path);

            $this->files[$name] = [
                'path'     => $path,
                'name'     => $name,
                'size'     => $size,
                'hsize'    => $this->humanFilesize($size),
                'modified' => $this->fileSystem->lastModified($path)
            ];
            unset($this->files[$key]);
        }

        return $this->files;
    }

    protected function shareData($data)
    {
        return view()->share('hlfiles', $data);
    }

    protected function humanFilesize($bytes, $decimals = 2)
    {
        $size   = ['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }
}