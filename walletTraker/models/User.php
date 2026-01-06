<?php

namespace App\Models;
require_once __DIR__ ."vendor/autoload.php";

class User{
    // attrubits user
    private $CIN;
    private $name;
    private $email;
    private $password;
    
    private $db;
    // construct user
    public function __construct($db, $cin, $name, $email, $password) {
        $this->db = AppModel\Database::getInstance();
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
}