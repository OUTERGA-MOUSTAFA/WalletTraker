<?php

include_once '../../classes/User.php';
if(isset($_POST['register'])){
   if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die('Something went wrong!');
    }else{
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
        $userClass = new User();
        if ($userClass->checkEmail($email)) {
            $errors[] = "Email déjà utilisé";
        }

        // Si aucune erreur → insertion
        if (empty($errors)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $userClass = new User($cin, $name, $email, $hashedPassword);
            $userClass->AddUser();

            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;

            echo "<script>alert('Inscription réussie')</script>";
            header("Location: login.php");
            exit;
        }

    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Create Account</h1>
                <p class="text-gray-600 mt-2">Join our <span class='text-green-400 text-bold'>Wallet Trake</span> today</p>
            </div>


            <form action="register.php" method="post" class="space-y-6">
                <!-- CIN Field -->
                 <?php if (!empty($errors)): ?>
                    <?php foreach ($errors as $error):?> 
                        <p class="text-red-600 text-center bg-red-200 p-2 rounded">
                            <?= htmlspecialchars($error) ?>
                        </p>
                    <?php endforeach; ?>
                <?php endif;?>
                <div class="space-y-2">
                    <label for="cin" class="block text-sm font-medium text-gray-700">
                        CIN <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" 
                               name="cin" 
                               id="cin" 
                               placeholder="Enter your CIN" 
                               
                               class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <i class="fas fa-id-card absolute left-3 top-3.5 text-gray-400"></i>
                    </div>
                </div>

                <!-- Username Field -->
                <div class="space-y-2">
                    <label for="username" class="block text-sm font-medium text-gray-700">
                        Username <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" 
                               name="username" 
                               id="username" 
                               placeholder="Choose a username" 
                               
                               class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <i class="fas fa-user absolute left-3 top-3.5 text-gray-400"></i>
                    </div>
                </div>

                <!-- Email Field -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="email" 
                               name="email" 
                               id="email" 
                               placeholder="example@email.com" 
                               
                               class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <i class="fas fa-envelope absolute left-3 top-3.5 text-gray-400"></i>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="password" 
                               id="password" 
                               placeholder="Create a strong password" 
                               
                               class="w-full px-4 py-3 pl-10 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <i class="fas fa-lock absolute left-3 top-3.5 text-gray-400"></i>
                        <button type="button" 
                                class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600"
                                onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500">Must be at least 6 characters long</p>
                </div>

                <!-- Confirm Password Field -->
                <div class="space-y-2">
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700">
                        Confirm Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="confirm_password" 
                               id="confirm_password" 
                               placeholder="Confirm your password" 
                               
                               class="w-full px-4 py-3 pl-10 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <i class="fas fa-lock absolute left-3 top-3.5 text-gray-400"></i>
                        <button type="button" 
                                class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600"
                                onclick="togglePassword('confirm_password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start">
                    <input type="checkbox" 
                           id="terms" 
                           name="terms"
                           required
                           class="mt-1 mr-2">
                    <label for="terms" class="text-sm text-gray-700">
                        I agree to the <a href="#" class="text-blue-600 hover:underline">Terms and Conditions</a> and <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" name="register" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center gap-2">
                    <span>Create Account</span>
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/>
                    </svg>
                </button>

                <!-- Login Link -->
                <div class="text-center mt-4">
                    <p class="text-gray-600 text-sm">
                        Already have an account? 
                        <a href="login.php" class="text-blue-600 hover:underline font-medium">Sign In</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>