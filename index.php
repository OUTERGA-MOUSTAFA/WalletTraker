<?php
// routing

define('BASE_PATH', '/walletTracker');
require_once __DIR__ . '/vendor/autoload.php';
// session_start() hna||
require_once __DIR__ . '/walletTraker/config/databaseSession.php';
//                    ||

use App\controleur\Auth;
use App\controleur\Dashboard;
// requiperé la valeur de request
// $uri = /register or /login or /dashboard
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace(BASE_PATH, '', $uri);     // /register
// requiperé la valeur de requist method
$method = $_SERVER['REQUEST_METHOD']; // POST

// first entre app
if ($uri === '/' || $uri === '') {
    if (empty($_SESSION['email'])) {
        header('Location: ' . BASE_PATH . '/register');
        exit();
    }elseif($_SESSION['login'] !== 'ok'){
        header('Location: ' . BASE_PATH . '/login');
        exit();
    } else {
        header('Location: ' . BASE_PATH . '/dashboard');
        exit();
    }
}


// if ($uri === '/register' && $method === 'POST') {
//     $auth = new Auth();
//     $auth->register();
// }
if ($uri === '/register' && $method === 'POST') {
    (new Auth())->register();
}

if ($uri === '/login' && $method === 'POST') {
    (new Auth())->login();
}

// controleur/Auth.php redirect to page
if ($uri === '/register' && $method === 'GET') {
    (new Auth())->showregister();
}

if ($uri === '/login' && $method === 'GET') {
    (new Auth())->showlogin();
}
if ($uri === '/dashboard' && $method === 'POST') {
    var_dump($_POST);
    (new dashboard())->showDashboard();
}