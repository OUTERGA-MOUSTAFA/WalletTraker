<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wallet Tracker - Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@material-tailwind/html@latest/scripts/popover.js"></script>
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/popover.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* Modal animations */
        .modal-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        /* Password toggle */
        .password-container {
            position: relative;
        }
        
        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #9ca3af;
        }
        
        .toggle-password:hover {
            color: #6b7280;
        }
        
        /* Error styling */
        .input-error {
            border-color: #ef4444 !important;
        }
        
        .error-text {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-6xl bg-white rounded-2xl shadow-2xl overflow-hidden">
        <div class="flex flex-col lg:flex-row">
            
            <!-- Left Side - Login Form -->
            <div class="lg:w-1/2 p-8 md:p-12 lg:p-16">
                <!-- Logo -->
                <div class="flex items-center mb-10">
                    <div class="bg-blue-100 p-3 rounded-xl mr-4">
                        <i class="fas fa-wallet text-2xl text-blue-600"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Wallet Tracker</h1>
                        <p class="text-sm text-gray-500">Gestion financière intelligente</p>
                    </div>
                </div>

                <!-- Error Alert -->
                <?php if (!empty($errors)): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl modal-fade-in">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-red-500 text-lg mt-0.5"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Erreurs de connexion</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Welcome -->
                <div class="mb-10">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Bienvenue</h2>
                    <p class="text-gray-600">Connectez-vous pour gérer vos finances</p>
                </div>

                <!-- Login Form -->
                <form action="/login" method="POST">
                    <!-- Email -->
                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 font-medium mb-2">Adresse email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input 
                                type="email" 
                                id="email" 
                                name="email"
                                value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 <?= (!empty($errors) && isset($_POST['email']) && empty($_POST['email'])) ? 'input-error' : '' ?>"
                                placeholder="votre@email.com"
                                
                            >
                        </div>
                        <?php if (!empty($errors) && isset($_POST['email']) && empty($_POST['email'])): ?>
                        <p class="error-text">L'email est requis</p>
                        <?php endif; ?>
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 font-medium mb-2">Mot de passe</label>
                        <div class="relative password-container">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                name="password"
                                class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 <?= (!empty($errors) && isset($_POST['password']) && empty($_POST['password'])) ? 'input-error' : '' ?>"
                                placeholder="Votre mot de passe"
                                
                            >
                            <span class="toggle-password" onclick="togglePasswordVisibility()">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        <?php if (!empty($errors) && isset($_POST['password']) && empty($_POST['password'])): ?>
                        <p class="error-text">Le mot de passe est requis</p>
                        <?php endif; ?>
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex justify-between items-center mb-8">
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                id="remember"
                                name="remember"
                                class="h-5 w-5 text-blue-600 rounded focus:ring-blue-500 border-gray-300"
                                <?= (isset($_POST['remember']) && $_POST['remember'] == 'on') ? 'checked' : '' ?>
                            >
                            <label for="remember" class="ml-2 text-gray-700">Se souvenir de moi</label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        name="connecter"
                        class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold py-3 px-4 rounded-xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 shadow-md hover:shadow-lg"
                    >
                        Se connecter
                    </button>
                    <div class="flex items-center my-8">
                        <div class="flex-grow border-t border-gray-300"></div>
                        <span class="mx-4 text-gray-500">Ou continuer avec</span>
                        <div class="flex-grow border-t border-gray-300"></div>
                    </div>
                    <!-- Signup Link -->
                    <div class="text-center">
                        <p class="text-gray-600">
                            Pas encore de compte?
                            <a href="/register" class="text-blue-600 hover:text-blue-800 font-medium ml-1 transition duration-200">
                                S'inscrire
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- Right Side - Wallet Tracker Visual -->
            <div class="lg:w-1/2 bg-gradient-to-br from-blue-900 to-blue-800 p-8 md:p-12 lg:p-16 text-white flex flex-col justify-center relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-blue-700 rounded-full -mr-32 -mt-32 opacity-20"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-600 rounded-full -ml-48 -mb-48 opacity-10"></div>
                
                <div class="relative z-10">
                    <!-- Title -->
                    <h2 class="text-3xl font-bold mb-6">
                        Gestion Wallet Tracker
                    </h2>
                    
                    <!-- Description -->
                    <p class="text-blue-100 text-lg mb-10 max-w-lg">
                        Suivez vos dépenses, économisez de l'argent et contrôlez vos finances chaque mois avec notre outil de gestion budgétaire intelligent.
                    </p>

                    <!-- Dashboard Preview -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 mb-10 border border-white/20">
                        <h3 class="text-xl font-semibold mb-4">Tableau de Bord Mensuel</h3>
                        
                        <!-- Chart -->
                        <div class="space-y-4">
                            <!-- Chart Bars -->
                            <div class="flex items-center">
                                <span class="w-24 text-sm">Alimentation</span>
                                <div class="flex-1 h-6 bg-blue-200/30 rounded-full overflow-hidden">
                                    <div class="h-full bg-green-400 rounded-full" style="width: 65%"></div>
                                </div>
                                <span class="w-16 text-right text-sm font-medium">650 DH</span>
                            </div>
                            
                            <div class="flex items-center">
                                <span class="w-24 text-sm">Transport</span>
                                <div class="flex-1 h-6 bg-blue-200/30 rounded-full overflow-hidden">
                                    <div class="h-full bg-blue-400 rounded-full" style="width: 45%"></div>
                                </div>
                                <span class="w-16 text-right text-sm font-medium">450 DH</span>
                            </div>
                            
                            <div class="flex items-center">
                                <span class="w-24 text-sm">Loisirs</span>
                                <div class="flex-1 h-6 bg-blue-200/30 rounded-full overflow-hidden">
                                    <div class="h-full bg-purple-400 rounded-full" style="width: 35%"></div>
                                </div>
                                <span class="w-16 text-right text-sm font-medium">350 DH</span>
                            </div>
                            
                            <div class="flex items-center">
                                <span class="w-24 text-sm">Logement</span>
                                <div class="flex-1 h-6 bg-blue-200/30 rounded-full overflow-hidden">
                                    <div class="h-full bg-yellow-400 rounded-full" style="width: 75%"></div>
                                </div>
                                <span class="w-16 text-right text-sm font-medium">2,500 DH</span>
                            </div>
                        </div>
                        
                        <!-- Monthly Total -->
                        <div class="mt-6 pt-6 border-t border-white/20 flex justify-between items-center">
                            <span class="font-medium">Total du mois</span>
                            <span class="text-xl font-bold">3,950 DH</span>
                        </div>
                    </div>

                    <!-- Features -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-start">
                            <div class="bg-blue-500 p-3 rounded-xl mr-4 mt-1">
                                <i class="fas fa-chart-pie text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Analyses Détaillées</h4>
                                <p class="text-blue-200 text-sm">Visualisez vos dépenses par catégories</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-green-500 p-3 rounded-xl mr-4 mt-1">
                                <i class="fas fa-bullseye text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Objectifs Mensuels</h4>
                                <p class="text-blue-200 text-sm">Définissez et suivez vos objectifs</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-purple-500 p-3 rounded-xl mr-4 mt-1">
                                <i class="fas fa-bell text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Alertes Intelligentes</h4>
                                <p class="text-blue-200 text-sm">Recevez des notifications budgétaires</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-red-500 p-3 rounded-xl mr-4 mt-1">
                                <i class="fas fa-piggy-bank text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Épargne Automatique</h4>
                                <p class="text-blue-200 text-sm">Programmez vos économies</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial -->
                    <div class="mt-10 pt-8 border-t border-white/20">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-blue-300 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-user text-blue-800 text-xl"></i>
                            </div>
                            <div>
                                <p class="italic text-blue-100">"Grâce à Wallet Tracker, j'ai économisé 30% de plus chaque mois!"</p>
                                <p class="text-sm text-blue-300 mt-1">- Karim, utilisateur depuis 6 mois</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Password visibility toggle
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
        
        // Modal functionality
        function closeModal() {
            const modal = document.getElementById('errorModal');
            if (modal) {
                modal.classList.remove('modal-fade-in');
                modal.style.opacity = '0';
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 300);
            }
        }
        
        // Auto-close modal on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
        
        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('errorModal');
            if (modal && event.target === modal) {
                closeModal();
            }
        });
        
        // Auto-focus email field if there's an error
        <?php if (!empty($errors)): ?>
        document.addEventListener('DOMContentLoaded', function() {
            const emailField = document.getElementById('email');
            if (emailField && !emailField.value) {
                emailField.focus();
            }
        });
        <?php endif; ?>
    </script>
</body>
</html>