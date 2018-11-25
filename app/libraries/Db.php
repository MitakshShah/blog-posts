<?php

/*
 * PDO database class
 * Connect to DB
 * Create Prepared Statement
 * Bind Values
 * Returnm rows and results
*/

class Db {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct() {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // var_dump($dsn);
        // exit;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create new PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            // var_dump($this->dbh);
            // exit;
        } catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Prepare Statment with query
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Bind the values
    public function bind($param, $value, $type = null){
        if(is_null(type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepare statement
    public function execute(){
        return $this->stmt->execute();
    }

    // Get result sets as array of objects
    public function getList(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record as object
    public function getItem(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function getCount(){
        return $this->stmt->rowCount();
    }

}