<?php
namespace App\models;
use App\models\database;
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/databaseSession.php';

//include_once 'database.php';

class checking{
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }
    // function to check email on database
    function checkEmail($email){
        $requet = 'SELECT email FROM users WHERE email = ?';
        $stm = $this->db->query($requet, [$email]);
        return $stm->rowCount() > 0;
    }
}