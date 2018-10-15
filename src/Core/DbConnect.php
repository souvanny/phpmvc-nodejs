<?php

namespace IAD;

use PDO;

class DbConnect
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new DbConnect();
        }

        return self::$instance;
    }

    public function init($config)
    {
        $this->connection = new PDO("mysql:host={$config['dbHost']}; dbname={$config['dbName']}",
            $config['dbUsername'],
            $config['dbPassword'],
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
        );
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function query($sql, $params)
    {
        $stmt= $this->connection->prepare($sql);
        $stmt->execute($params);
    }

    public function fetchAll($sql, $params)
    {
        $stm = $this->connection->prepare($sql);
        $stm->execute($params);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
}