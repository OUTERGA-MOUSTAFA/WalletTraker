<?php

namespace App\models;
use App\config\databaseSession;
use App\models\database;

// require ola include only on index.php
// require_once 'database.php'; 
class User{
    // attrubits user
    private $CIN;
    private $name;
    private $email;
    private $password;
    
    private $db;
    // construct user
    public function __construct($cin, $name, $email, $password) {
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
    function AddUser(){
        try {
            
            $requet = "INSERT INTO users (cin, name, email, password_hash)
            VALUES (?, ?, ?, ?)";
            var_dump($this->getEmail());
            $this->db->query($requet, [
                $this->getCin(),
                $this->getName(),
                $this->getEmail(),
                $this->getPassword()
            ]);
            $this->wallet();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function wallet(){
        
        try{
            $requet = "INSERT INTO wallet (cin_user, budget) VALUES (?, ?)";
            $this->db->query($requet, [$this->getCin() , 0]);
        }catch(Exception $e){
            return false;
        }
    }
}