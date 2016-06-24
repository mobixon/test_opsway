<?php

namespace OpsWay\Migration\Logger;

use OpsWay\Migration\Writer\WriterFactory;

class OutOfStockLogger
{
    protected  $logWriter;

    public function __construct()
    {
        $this->logWriter = WriterFactory::create('File\Csv');
    }
    
    public function check($item, $status, $msg)
    {
        if($item['qty'] == 0 & $item['is_stock'] == 0){
            $this->logWriter->write($item, "data/output.log.csv");
        }
    }
}
