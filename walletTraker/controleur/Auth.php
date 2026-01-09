<?php
namespace App\controleur;
use App\models\cheking;
// var_dump($_POST);
use App\config\databaseSession;
use App\models\User;

class Auth {

    // GET view register
    public function showRegister($errors = []) {
    
        require __DIR__ . '/../view/auth/register.php';
    }

    // GET view login
    public function showLogin($errors = []) {
    
        require __DIR__ . '/../view/auth/login.php';
    }

    public function login() {
        $email = strip_tags(trim($_POST['email'] ?? ''));
        $password = strip_tags(trim($_POST['password'] ?? ''));
        $errors = [];
        if(empty($email)){
            $errors []= "Email est obligatoire!";
        }
        if(empty($password)){
            $errors []= "Password est obligatoire!";
        }
        $check = new cheking();
        $emailResult = $check->checkEmail($email);
        if (!$emailResult) {
            $errors[] = "Email pas correct";
        } else {
            $passResult = $check->checkPassword($email);

            if (!password_verify($password, $passResult['password_hash'])) {
                $errors[] = "Password pas correct";
            }
        }
                // redirigé vers
        if (!empty($errors)) {
            // function li dakhel class khem biha 
            $this->showLogin($errors);
            exit();
        }elseif(empty($errors)) {
            $_SESSION['login'] = 'ok';
            echo "<script>alert('Connexion réussie')'</script>";
            require_once __DIR__ . '/../view/wallet_dashboard.php';
            exit();
        }else{
        header('location: /login');
        exit();
        }



    }


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
        
        $checkEmail = new cheking();
        if ($checkEmail->checkEmail($email)) {
            $errors[] = "Email déjà utilisé";
        }
        // Si aucune erreur → insertion
        if (!empty($errors)) {
            // function li dakhel class khem biha 
            $this->showRegister($errors);
            exit();

        }elseif(empty($errors)) {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $userClass = new User($cin, $name, $email, $hashedPassword);
            $result = $userClass->AddUser();
            if($result === true){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                showLogin($array[]);
            }
            echo "<script>alert('Inscription réussie') window.location.href = '/login';</script>";
            exit();
        }else{
        header('location: /register');
        exit();
        }
    }
}
