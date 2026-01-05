<?php

class User{
    // attrubits user
    private $CIN;
    private $name;
    private $email;
    private $password;
    // construct user
    function __construct($cin,$name,$email,$password){
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
    

    function AddUser(){
        $requet = 'INSERT INTO users(CIN, name, email, password) VALUES (CIN = ?, name=?, email=?, password=?)';
        
    }

}