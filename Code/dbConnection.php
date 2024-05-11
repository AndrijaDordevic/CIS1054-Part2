<?php 

 class Db {
    protected static $connection;

    public function connect() {
        // Try and connect to the database
        if(!isset(self::$connection)) {
            // Load configuration as an array. Use the actual location of your configuration file
            // Put the configuration file outside of the document root
            $config = parse_ini_file('./config.ini'); 
            self::$connection = new mysqli($config['username'],$config['password'],$config['dbname'],$config['server']);
        }
    
        // If connection was not successful, handle the error
        if(self::$connection === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            return false;
        }
        return self::$connection;
    }

    public function query($query) {
        // Connect to the database
        $connection = $this -> connect();
        
        // Query the database
        $result = $connection -> query($query);
        
        return $result;
    }

    /**
     * Fetch rows from the database (SELECT query)
     */
    public function select($query) {
        $rows = array();
        $result = $this -> query($query);
        if($result === false) {
            return false;
        }
        while ($row = $result -> fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
    /**
     * Fetch the last error from the database
     */
    public function error() {
        $connection = $this -> connect();
        return $connection -> error;
    }

    /**
     * Quote and escape value for use in a database query
     */
    public function quote($value) {
        $connection = $this -> connect();
        return "'" . $connection -> real_escape_string($value) . "'";
    }
}
