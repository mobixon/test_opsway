<?php

namespace OpsWay\Migration\Reader\File;

use OpsWay\Migration\Reader\ReaderInterface;

class Csv implements ReaderInterface
{
    protected $file;
    protected $filename="data/export.csv";
    protected $columnNames;

    /**
     * @return array|null
     */
    public function read()
    {
        if (!$this->file) {
            if (!($this->file = fopen($this->filename, 'r'))) {
                throw new \RuntimeException(sprintf('Can not read file "%s" for parse data.', $this->filename));
            }
            foreach(fgetcsv($this->file, 0, ",") as  $key => $col_names)
               $this->columnNames[$key] = $col_names;
        }
        $row = fgetcsv($this->file, 0, ",");
        if($row){
            foreach ($row as $key => $value) {
                $fetch_result[$this->columnNames[$key]] = $value;
            }
        }else{
            $fetch_result = null;
        }
        return $fetch_result;
    }

    public function __destruct()
    {
        if ($this->file) {
            fclose($this->file);
        }
    }
}
