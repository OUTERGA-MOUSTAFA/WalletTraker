<?php
namespace App\models;

use App\models\database;

class dashboard{

    private $cin_user;
    private $budget;

    private static $db;

    function __construct($cin_user,$budget) {

        self::$db = database::getInstance();

        $this->cin_user = $cin_user;
        $this->budget = $budget;

    }

    //getters
    function getCin_user(){return $this->cin_user;}
    function getBudget(){return $this->budget;}

    function wallet(){ 
        try{
            $requet = "INSERT INTO wallet (cin_user, budget) VALUES (?, ?)";
            static::$db->query($requet, [$this->getCin_user(), $this->getBudget()]);
        }catch(Exception $e){
            return false;
        }
    }
    static function getWallet(){
        try{
            $db = database::getInstance();
            
            $requet = "SELECT w.*, u.* FROM wallet w JOIN users u ON w.cin_user = u.CIN  WHERE cin_user = ?";
            $pdoStmt = $db->query($requet, [$_SESSION['cin']]);
            $result = $pdoStmt->fetch(); // one fetch 
            if($result === null) return null;
            return $result;
        }catch(Exception $e){
            return false;
        }
    }
}