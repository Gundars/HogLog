<?php

namespace HogLog;

/**
 * Class HogLogPlanB
 * Browse directories and files via API
 * Used when your Laravel/Lumen installation does not boot
 * HogLog\PlanB::getInstance()->view(string $jailDir[, array $whitelistFilenames])
 * HogLog\PlanB::getInstance()->view('../', ['.log', '.txt']);
 *
 * todo: enable whitelist
 * todo: ensure jaildir boundaries
 * todo: optional view() parameter enableDir
 *
 */
class PlanB
{
    /**
     * @var PlanB The reference to *HogLog\PlanB* instance of this class
     */
    private static $instance;

    /**
     * @var string Directory path browsing is limited to
     */
    private static $jailDir;

    /**
     * @var null/array List of allowed filenames
     */
    private static $whitelistFilenames = null;

    /**
     * @var array current url
     */
    private static $urlInfo;

    /**
     * @var array Reference to either $_GET or $_POST
     */
    private static $requestMethod;

    /**
     * Returns the instance of this class.
     * @return HogLogPlanB singleton instance.
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public static function view($jailDir = '/', $whitelistFilenames = null)
    {
        self::$jailDir            = $jailDir;
        self::$whitelistFilenames = $whitelistFilenames;

        self::setupRequestMethod();
        $currentUrl    = "//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        self::$urlInfo = self::parseUrl($currentUrl);

        echo self::output();
    }

    protected static function output()
    {
        $jailDir  = __DIR__ . '/' . self::$jailDir;
        $browse   = self::$urlInfo['browse'];
        $html = self::readOrWheep($jailDir . '/' . $browse);
        return $html;
    }

    protected static function readOrWheep($path)
    {
        if (!file_exists($path)) {
            throw new \Exception("Directory/file does not exist $path");
        }

        if (is_file($path)) {
            $contents = self::readFile($path);
        } elseif (is_dir($path)) {
            $contents = self::readDir($path, "Directory $path contents: <br/>");
        } else {
            $contents = 'Directory/file not recognised';
        }

        return $contents;
    }

    /**
     * @param string $path
     * @param string $html
     * @return string
     * @throws Exception
     */
    protected static function readFile($path, $html = '')
    {
        $handle = fopen($path, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $html .= '<p>' . $line . '</p>';
            }
            fclose($handle);
        } else {
            throw new \Exception("Error reading file $path");
        }

        return $html;
    }

    /**
     * @param        $path
     * @param string $html
     * @return string
     */
    protected static function readDir($path, $html = '') {
        $html .= '<p>' . implode('</p><p>', scandir($path)) . '</p>';
        return $html;
    }

    /**
     * Pare URL into array
     * @param $url string URL to parse, protocol is optional
     * @return array $url
     *             ["host" => "www.example.com",
     *             "path" => "/path",
     *             "query" => "name=value",
     *             "browse" => "../app/storage/logs/"]
     */
    protected static function parseUrl($url)
    {
        $url = parse_url($url);
        if (array_key_exists('browse', self::$requestMethod)) {
            $url['browse'] = self::$requestMethod['browse'];
        }
        return $url;
    }

    /**
     * Sets up request method as reference to ether $_GET or $_POST
     * @return array
     */
    protected static function setupRequestMethod()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                self::$requestMethod = &$_GET;
                break;
            case 'POST':
                self::$requestMethod = &$_POST;
                break;
            default:
        }
        return self::$requestMethod;
    }

    /**
     * Protected constructor to prevent creating a new instance of the
     * *HogLogPlanB* via the `new` operator from outside of this class.
     */
    protected function __construct()
    {
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *HogLogPlanB* instance.
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Private unserialise method to prevent unserialising of the HogLogPlanB
     * instance.
     * @return void
     */
    private function __wakeup()
    {
    }
}

\HogLog\PlanB::getInstance()->view('../', ['.log', '.txt']);