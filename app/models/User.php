<?php

class User {
    private $db;

    public function __construct() {
        $this->db = new Db;
    }

    // Register User
    public function register($data){
        $this->db->query("INSERT INTO users (name,email,password) VALUES (:name,:email,:password)");
        // Bind values
        $this->db->bind(':name',$data['name']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':password',$data['password']);

        // Execute Query
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
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