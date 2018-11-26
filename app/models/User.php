<?php

class User {
    private $db;

    public function __construct() {
        $this->db = new Db;
    }

    // Find user by email
    public function findUserByEmail($email){
        $this->db->query("SELECT * from users WHERE email = :email");
        $this->db->bind(':email',$email);

        $row = $this->db->getItem();

        // Check row 
        if($this->db->getCount() > 0 ){
            return true;
        } else {
            return false;
        }
    }
}