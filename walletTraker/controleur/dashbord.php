<?php

namespace App\controleur;
// use App\view\wallet_dashboard;

class dashboard{
    
    // GET view dashboard
    public function showDashboard() {
        require __DIR__ . '/../view/wallet_dashboard.php';
    }

}