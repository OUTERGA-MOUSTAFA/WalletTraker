<?php
include_once 'database.php';
class User{
    // attrubits user
    private $CIN;
    private $name;
    private $email;
    private $password;
    
    private $db;
    // construct user
    public function __construct($db, $cin, $name, $email, $password) {
        $this->db = Database::getInstance();
        $this->CIN = $cin;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
    
   
    // getters
    function getCin(){return $this->CIN;}
    function getName(){return $this->name;}
    function getEmail(){return $this->email;}
    function getPassword(){return $this->password;}
    
    // funtion to create user
    function AddUser($user){
        $requet = 'INSERT INTO users(CIN, name, email, password) VALUES VALUES (?, ?, ?, ?)';
        return $this->db->query($requet, [
            $this->CIN,
            $this->name,
            $this->email,
            $this->password
        ]);
    }
    // function to check email on database
    function checkEmail($email){
        $requet = 'SELECT email FROM users WHERE email = ?';
        $stm = $this->db->query($requet, [$email]);
        return $stm->fetch();
    }

}