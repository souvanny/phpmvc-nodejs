<?php
/**
 * Created by PhpStorm.
 * User: ssise
 * Date: 14/10/2018
 * Time: 12:38
 */

namespace IAD;


class Config
{
    protected $config;

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $this->config = [];

        $files = $this->getDirContents(__DIR__ . '/../../config');

        foreach($files as $file) {
            if(!is_dir($file)) {
                $this->config = array_merge($this->config, include($file));
            }
        }
    }

    public function getValues()
    {
        return $this->config;
    }


    protected function getDirContents($dir, &$results = array()){
        $files = scandir($dir);

        foreach($files as $key => $value){
            $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
            if(!is_dir($path)) {
                $results[] = $path;
            } else if($value != "." && $value != "..") {
                $this->getDirContents($path, $results);
                $results[] = $path;
            }
        }

        return $results;
    }

}