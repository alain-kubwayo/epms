<?php

class Database{
    // Initializing 'epms_db' database variables
    private $servername;
    private $username;
    private $password;
    private $dbname;

    // Method to connecct to the database 'epms_db'
    public function connect(){
        $this->servername = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->dbname = 'epms_db';

        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        return $conn;
    }
}
?>