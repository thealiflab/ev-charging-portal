<?php

class Database {
    private static $instance = null; 
    private $conn;

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $name = 'ev';

    private function __construct(){
        try {
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->name);
        }
        catch (mysqli_sql_exception $error) {
            die("Connection failed: " . $error->getCode().": ".$error->getMessage());
        }
    }

    # Singleton design pattern for managing database connections. 
    # Example: A new coffee machine just to make a cup of coffee, it would be waste space and money. We use one shared machine which is this the singleton.
    public static function getInstance() {
        if(!self::$instance){
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(){
        return $this->conn;
    }

}

?>

