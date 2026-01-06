<?php
namespace App\controleur;
use App\models\cheking;
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/databaseSession.php';


class AuthController {
    public function login() {}
    public function register() {


        // Récupération et nettoyage
        $cin = trim($_POST['cin'] ?? '');
        $name = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirm_password = $_POST['confirm_password'] ?? '';

        $errors = [];

        // Validations
        if (empty($cin)) {
            $errors[] = "Le champ CIN est obligatoire";
        }

        if (empty($name)) {
            $errors[] = "Le champ name est obligatoire";
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email invalide ou vide";
        }

        if (empty($password)) {
            $errors[] = "Le champ Password est obligatoire";
        } elseif (strlen($password) < 8) {
            $errors[] = "Le mot de passe doit contenir au moins 8 caractères";
        }

        if (empty($confirm_password)) {
            $errors[] = "Veuillez confirmer le mot de passe";
        } elseif ($password !== $confirm_password) {
            $errors[] = "Les mots de passe ne correspondent pas";
        }
        // Vérifier le doublement email en DB
        
        $Email = new checking();
        
        if ($Email->checkEmail($email)) {
            $errors[] = "Email déjà utilisé";
        }
        // Si aucune erreur → insertion
        if (!empty($errors)) {
            require '../views/auth/register.php';
            exit;
        }elseif(empty($errors)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $userClass = new User($cin, $name, $email, $hashedPassword);
            $result = $userClass->AddUser();
            if($result){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
            }
            echo "<script>alert('Inscription réussie') window.location.href = '/login';</script>";
            exit;
        }else{
        header('location: /register');
        exit;
        }
    }
}