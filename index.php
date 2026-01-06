<?php

require_once __DIR__ . '/../vendor/autoload.php';
// session_start() hna||
require_once __DIR__ . '/../config/databaseSession.php';
//                    ||
// routing
if($_SESSION['name'] === ''){
    header('location:/register');
}elseif($_SESSION['email'] === ''){
    header('location:/login');
}
$uri = $_SERVER['REQUEST_URI'];      // /register
$method = $_SERVER['REQUEST_METHOD']; // POST

if ($uri === '/register' && $method === 'POST') {
    (new AuthController())->register();
}
if ($uri === '/login' && $method === 'POST') {
    (new AuthController())->login();
}