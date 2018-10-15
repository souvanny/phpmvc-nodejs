<?php
namespace ClassesClasses;


class Sessions {

    
    private static $instance;

    private function __construct($controller) {
    }

    public static function getInstance() {
        if (true === is_null(self::$instance)) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }


}

?>