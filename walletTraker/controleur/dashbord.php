<?php

namespace App\controleur;
use App\models\dashboard;

class Dashbord{
    // GET view dashboard

    public function showDashboard() {
        
        $walletinfos = dashboard::getWallet()?? [];
        require __DIR__ . '/../view/wallet_dashboard.php';
    }
}