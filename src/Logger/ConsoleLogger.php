<?php

use OpsWay\Migration\Logger\OutOfStockLogger;

namespace OpsWay\Migration\Logger;

class ConsoleLogger
{
    static public $countItem = 0;
    protected $debug;
    protected $OutOfStockLogger;

    public function __construct($mode = false)
    {
        $this->debug = $mode;
        $this->OutOfStockLogger = new OutOfStockLogger();
    }

    public function __invoke($item, $status, $msg)
    {
        if ((++self::$countItem % 2) == 0 && $this->debug) {
            echo self::$countItem . " ";
            $this->OutOfStockLogger->check($item, $status, $msg);
        }
        if (!$status) {
            echo "Warning: " . $msg . print_r($item, true) . PHP_EOL;
        }
    }
}
