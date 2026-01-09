<?php




class dashboard{

    private $budget = 0;
    private $cin_user;

    private $db;

    function __construct($id, $budget, $cin_user) {

        $this->db = database::getInstance();

        $this->budget = $budget;
        $this->cin_user = $cin_user;

    }

    //getters
    function getBudget(){return $this->budget;}
    function getCin_user(){return $this->cin_user;}

    function wallet(){ 
        try{
            $requet = "INSERT INTO wallet (cin_user, budget) VALUES (?, ?)";
            $this->db->query($requet, [$this->getCin_user(), $this->getBudget()]);
        }catch(Exception $e){
            return false;
        }
    }
}