<?php
class database
{
    private $_host = "localhost:3306";
    private $_name = "test";
    private $_user = "test";
    private $_pswd = "testtest" ;

    private static $_instance;

    private function __clone(){}

    public static function getInstance() {
        if(!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct(){

        $this->_connection  = new mysqli($this->_host,$this->_user,$this->_pswd,$this->_name);
        if(mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
                E_USER_ERROR);
        }

    }

    public function get_file_data($user){
        
    }

}