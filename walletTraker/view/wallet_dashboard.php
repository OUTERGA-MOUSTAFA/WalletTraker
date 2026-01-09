<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Wallet Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Chart.js pour les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            min-height: 100vh;
        }
        
        .dashboard-title {
            font-family: 'Poppins', sans-serif;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .gradient-secondary {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        
        .gradient-accent {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        
        .gradient-success {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }
        
        .gradient-warning {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }
        
        .shadow-soft {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        
        .shadow-hard {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }
        
        .hover-lift:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }
        
        .smooth-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .category-badge {
            border-radius: 12px;
            padding: 6px 16px;
            font-weight: 500;
            font-size: 0.875rem;
        }
        
        .progress-ring {
            transform: rotate(-90deg);
        }
        
        .progress-ring-circle {
            stroke-dasharray: 283;
            stroke-dashoffset: 283;
            transition: stroke-dashoffset 0.5s ease;
        }
    </style>
</head>
<body class="text-gray-800">
    <!-- Navigation Bar -->
    <nav class="glass-card fixed top-0 left-0 right-0 z-50 px-6 py-4 mx-4 mt-4 rounded-2xl">
        <div class="flex items-center justify-between">
            <!-- Logo et nom -->
            <div class="flex items-center space-x-4">
                <div class="gradient-primary p-3 rounded-xl">
                    <i class="fas fa-wallet text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="dashboard-title text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                        Wallet Tracker
                    </h1>
                    <p class="text-sm text-gray-500">Gestion financière premium</p>
                </div>
            </div>
            
            <!-- Date et recherche -->
            <div class="hidden md:flex items-center space-x-6">
                <div class="text-center">
                    <p class="text-sm text-gray-500">Aujourd'hui</p>
                    <p class="font-semibold"><?php echo date('d M Y'); ?></p>
                </div>
                <div class="relative">
                    <input type="text" placeholder="Rechercher..." 
                           class="pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent w-64">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
            
            <!-- Profil et notifications -->
            <div class="flex items-center space-x-4">
                <button class="relative p-2 hover:bg-gray-100 rounded-xl">
                    <i class="fas fa-bell text-gray-600 text-xl"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
                
                <!-- Menu Profil -->
                <div class="relative group">
                    <div class="flex items-center space-x-3 cursor-pointer">
                        <div class="relative">
                            <div class="w-10 h-10 gradient-primary rounded-full flex items-center justify-center text-white font-bold">
                                KA
                            </div>
                            <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                        </div>
                        <div class="hidden md:block">
                            <p class="font-semibold">Karim Ahmed</p>
                            <p class="text-sm text-gray-500">Premium Member</p>
                        </div>
                        <i class="fas fa-chevron-down text-gray-400"></i>
                    </div>
                    
                    <!-- Dropdown Profil -->
                    <div class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-hard border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                        <div class="p-4 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 gradient-primary rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    KA
                                </div>
                                <div>
                                    <p class="font-bold">Karim Ahmed</p>
                                    <p class="text-sm text-gray-500">karim@example.com</p>
                                </div>
                            </div>
                        </div>
                        <div class="py-2">
                            <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                                <i class="fas fa-user-circle mr-3"></i>
                                Mon Profil
                            </a>
                            <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                                <i class="fas fa-cog mr-3"></i>
                                Paramètres
                            </a>
                            <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                                <i class="fas fa-question-circle mr-3"></i>
                                Aide & Support
                            </a>
                        </div>
                        <div class="p-4 border-t border-gray-100">
                            <a href="#" class="flex items-center justify-center px-4 py-2 gradient-primary text-white font-medium rounded-lg hover:opacity-90">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Déconnexion
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-24 px-4 md:px-8 pb-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header avec salutation -->
            <div class="mb-8">
                <h2 class="dashboard-title text-3xl font-bold mb-2">Bonjour, Karim 👋</h2>
                <p class="text-gray-600">Voici votre résumé financier du mois</p>
            </div>
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Budget du mois -->
                <div class="glass-card p-6 rounded-2xl shadow-soft hover-lift">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-gray-500 text-sm">Budget du mois</p>
                            <h3 class="text-2xl font-bold mt-2">5,000 DH</h3>
                        </div>
                        <div class="gradient-primary p-3 rounded-xl">
                            <i class="fas fa-coins text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="flex items-center text-sm">
                        <span class="text-green-500 font-medium">
                            <i class="fas fa-arrow-up mr-1"></i> 12%
                        </span>
                        <span class="text-gray-500 ml-2">vs dernier mois</span>
                    </div>
                </div>
                
                <!-- Dépenses -->
                <div class="glass-card p-6 rounded-2xl shadow-soft hover-lift">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-gray-500 text-sm">Dépenses</p>
                            <h3 class="text-2xl font-bold mt-2">3,250 DH</h3>
                        </div>
                        <div class="gradient-secondary p-3 rounded-xl">
                            <i class="fas fa-shopping-cart text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="flex items-center text-sm">
                        <span class="text-red-500 font-medium">
                            <i class="fas fa-arrow-up mr-1"></i> 8%
                        </span>
                        <span class="text-gray-500 ml-2">vs dernier mois</span>
                    </div>
                </div>
                
                <!-- Reste -->
                <div class="glass-card p-6 rounded-2xl shadow-soft hover-lift">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-gray-500 text-sm">Reste à dépenser</p>
                            <h3 class="text-2xl font-bold mt-2">1,750 DH</h3>
                        </div>
                        <div class="gradient-success p-3 rounded-xl">
                            <i class="fas fa-piggy-bank text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="flex items-center text-sm">
                        <span class="text-green-500 font-medium">
                            <i class="fas fa-arrow-down mr-1"></i> 15%
                        </span>
                        <span class="text-gray-500 ml-2">économies</span>
                    </div>
                </div>
                
                <!-- Objectif épargne -->
                <div class="glass-card p-6 rounded-2xl shadow-soft hover-lift">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-gray-500 text-sm">Objectif épargne</p>
                            <h3 class="text-2xl font-bold mt-2">1,200 DH</h3>
                        </div>
                        <div class="gradient-accent p-3 rounded-xl">
                            <i class="fas fa-bullseye text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="gradient-accent h-2 rounded-full" style="width: 65%"></div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">65% atteint</p>
                </div>
            </div>
            
            <!-- Graphique et Détails -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Graphique principal -->
                <div class="lg:col-span-2">
                    <div class="glass-card p-6 rounded-2xl shadow-soft h-full">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold">Évolution des dépenses</h3>
                            <div class="flex space-x-2">
                                <button class="px-4 py-2 bg-purple-100 text-purple-600 font-medium rounded-lg">
                                    Mensuel
                                </button>
                                <button class="px-4 py-2 text-gray-500 font-medium rounded-lg hover:bg-gray-100">
                                    Annuel
                                </button>
                            </div>
                        </div>
                        <div class="h-80">
                            <canvas id="expenseChart"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Progression du budget -->
                <div class="glass-card p-6 rounded-2xl shadow-soft">
                    <h3 class="text-xl font-bold mb-6">Progression du budget</h3>
                    
                    <!-- Cercle de progression -->
                    <div class="flex justify-center mb-6">
                        <div class="relative w-48 h-48">
                            <svg class="w-full h-full" viewBox="0 0 100 100">
                                <!-- Cercle de fond -->
                                <circle cx="50" cy="50" r="45" fill="none" stroke="#e5e7eb" stroke-width="8"/>
                                <!-- Cercle de progression -->
                                <circle id="progress-circle" cx="50" cy="50" r="45" fill="none" 
                                        stroke="url(#progressGradient)" stroke-width="8" 
                                        stroke-linecap="round" stroke-dasharray="283" stroke-dashoffset="99"/>
                                
                                <defs>
                                    <linearGradient id="progressGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                        <stop offset="0%" stop-color="#667eea" />
                                        <stop offset="100%" stop-color="#764ba2" />
                                    </linearGradient>
                                </defs>
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span class="text-3xl font-bold">65%</span>
                                <span class="text-gray-500">du budget utilisé</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Légende -->
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-purple-500 rounded-full mr-3"></div>
                                <span>Dépenses</span>
                            </div>
                            <span class="font-bold">3,250 DH</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                <span>Reste</span>
                            </div>
                            <span class="font-bold">1,750 DH</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Dépenses par catégorie et Transactions récentes -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Dépenses par catégorie -->
                <div class="lg:col-span-2">
                    <div class="glass-card p-6 rounded-2xl shadow-soft">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold">Dépenses par catégorie</h3>
                            <button class="text-purple-600 font-medium hover:text-purple-700">
                                Voir tout <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                        
                        <div class="space-y-6">
                            <!-- Catégorie 1 -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 smooth-transition">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 gradient-primary rounded-xl flex items-center justify-center mr-4">
                                        <i class="fas fa-home text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Logement</p>
                                        <p class="text-sm text-gray-500">Loyer, électricité, eau</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold">1,500 DH</p>
                                    <div class="w-48 bg-gray-200 rounded-full h-2 mt-2">
                                        <div class="gradient-primary h-2 rounded-full" style="width: 75%"></div>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1">75% du budget catégorie</p>
                                </div>
                            </div>
                            
                            <!-- Catégorie 2 -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 smooth-transition">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 gradient-secondary rounded-xl flex items-center justify-center mr-4">
                                        <i class="fas fa-utensils text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Alimentation</p>
                                        <p class="text-sm text-gray-500">Courses, restaurants</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold">650 DH</p>
                                    <div class="w-48 bg-gray-200 rounded-full h-2 mt-2">
                                        <div class="gradient-secondary h-2 rounded-full" style="width: 65%"></div>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1">65% du budget catégorie</p>
                                </div>
                            </div>
                            
                            <!-- Catégorie 3 -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 smooth-transition">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 gradient-accent rounded-xl flex items-center justify-center mr-4">
                                        <i class="fas fa-car text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Transport</p>
                                        <p class="text-sm text-gray-500">Essence, taxi, bus</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold">450 DH</p>
                                    <div class="w-48 bg-gray-200 rounded-full h-2 mt-2">
                                        <div class="gradient-accent h-2 rounded-full" style="width: 45%"></div>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1">45% du budget catégorie</p>
                                </div>
                            </div>
                            
                            <!-- Catégorie 4 -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 smooth-transition">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 gradient-warning rounded-xl flex items-center justify-center mr-4">
                                        <i class="fas fa-film text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Loisirs</p>
                                        <p class="text-sm text-gray-500">Cinéma, sorties, hobbies</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold">350 DH</p>
                                    <div class="w-48 bg-gray-200 rounded-full h-2 mt-2">
                                        <div class="gradient-warning h-2 rounded-full" style="width: 35%"></div>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1">35% du budget catégorie</p>
                                </div>
                            </div>
                            
                            <!-- Catégorie 5 -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 smooth-transition">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 gradient-success rounded-xl flex items-center justify-center mr-4">
                                        <i class="fas fa-shirt text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Shopping</p>
                                        <p class="text-sm text-gray-500">Vêtements, accessoires</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold">300 DH</p>
                                    <div class="w-48 bg-gray-200 rounded-full h-2 mt-2">
                                        <div class="gradient-success h-2 rounded-full" style="width: 30%"></div>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1">30% du budget catégorie</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Transactions récentes -->
                <div class="glass-card p-6 rounded-2xl shadow-soft">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold">Transactions récentes</h3>
                        <button class="text-purple-600 font-medium hover:text-purple-700">
                            Voir tout <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                    
                    <div class="space-y-4">
                        <!-- Transaction 1 -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 smooth-transition">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center mr-3">
                                    <i class="fas fa-shopping-bag text-red-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Carrefour</p>
                                    <p class="text-sm text-gray-500">Aujourd'hui, 14:30</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-red-600">- 230 DH</p>
                                <span class="category-badge bg-red-100 text-red-600">Alimentation</span>
                            </div>
                        </div>
                        
                        <!-- Transaction 2 -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 smooth-transition">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mr-3">
                                    <i class="fas fa-gas-pump text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Station Shell</p>
                                    <p class="text-sm text-gray-500">Hier, 18:15</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-red-600">- 180 DH</p>
                                <span class="category-badge bg-blue-100 text-blue-600">Transport</span>
                            </div>
                        </div>
                        
                        <!-- Transaction 3 -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 smooth-transition">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center mr-3">
                                    <i class="fas fa-film text-purple-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Cinéma Megarama</p>
                                    <p class="text-sm text-gray-500">5 Mars, 20:00</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-red-600">- 120 DH</p>
                                <span class="category-badge bg-purple-100 text-purple-600">Loisirs</span>
                            </div>
                        </div>
                        
                        <!-- Transaction 4 -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 smooth-transition">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center mr-3">
                                    <i class="fas fa-money-bill-wave text-green-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Salaire</p>
                                    <p class="text-sm text-gray-500">1 Mars, 09:00</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-green-600">+ 8,500 DH</p>
                                <span class="category-badge bg-green-100 text-green-600">Revenu</span>
                            </div>
                        </div>
                        
                        <!-- Transaction 5 -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 smooth-transition">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center mr-3">
                                    <i class="fas fa-wifi text-yellow-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Facture internet</p>
                                    <p class="text-sm text-gray-500">28 Fév, 12:00</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-red-600">- 299 DH</p>
                                <span class="category-badge bg-yellow-100 text-yellow-600">Logement</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h4 class="font-bold mb-4">Actions rapides</h4>
                        <div class="grid grid-cols-2 gap-3">
                            <button class="flex items-center justify-center p-3 bg-purple-50 text-purple-600 font-medium rounded-xl hover:bg-purple-100">
                                <i class="fas fa-plus mr-2"></i> Ajouter
                            </button>
                            <button class="flex items-center justify-center p-3 bg-blue-50 text-blue-600 font-medium rounded-xl hover:bg-blue-100">
                                <i class="fas fa-chart-pie mr-2"></i> Rapport
                            </button>
                            <button class="flex items-center justify-center p-3 bg-green-50 text-green-600 font-medium rounded-xl hover:bg-green-100">
                                <i class="fas fa-download mr-2"></i> Exporter
                            </button>
                            <button class="flex items-center justify-center p-3 bg-pink-50 text-pink-600 font-medium rounded-xl hover:bg-pink-100">
                                <i class="fas fa-cog mr-2"></i> Réglages
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="mt-8 pt-6 border-t border-gray-200 text-center text-gray-500 text-sm">
                <p>© 2024 Wallet Tracker. Tous droits réservés. | <a href="#" class="text-purple-600 hover:text-purple-700">Confidentialité</a> • <a href="#" class="text-purple-600 hover:text-purple-700">Conditions</a></p>
            </div>
        </div>
    </main>

    <!-- Script pour les graphiques -->
    <script>
        // Initialiser le graphique des dépenses
        const ctx = document.getElementById('expenseChart').getContext('2d');
        const expenseChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Dépenses (DH)',
                    data: [2800, 2950, 3100, 3250, 3400, 3550, 3700, 3850, 4000, 4150, 4300, 4450],
                    borderColor: 'rgba(102, 126, 234, 1)',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(102, 126, 234, 1)',
                    pointRadius: 5,
                    pointHoverRadius: 8
                }, {
                    label: 'Budget (DH)',
                    data: [3000, 3000, 3000, 3000, 3000, 3000, 3000, 3000, 3000, 3000, 3000, 3000],
                    borderColor: 'rgba(118, 75, 162, 0.5)',
                    borderWidth: 2,
                    borderDash: [5, 5],
                    fill: false,
                    tension: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 12,
                                family: "'Inter', sans-serif"
                            },
                            padding: 20,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.9)',
                        titleColor: '#1f2937',
                        bodyColor: '#1f2937',
                        borderColor: '#e5e7eb',
                        borderWidth: 1,
                        padding: 12,
                        boxPadding: 6,
                        usePointStyle: true,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' DH';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            callback: function(value) {
                                return value + ' DH';
                            },
                            font: {
                                size: 11
                            }
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });
        
        // Animation du cercle de progression
        document.addEventListener('DOMContentLoaded', function() {
            const progressCircle = document.getElementById('progress-circle');
            const progress = 65; // 65% utilisé
            const circumference = 283;
            const offset = circumference - (progress / 100 * circumference);
            
            // Définir l'animation après un léger délai pour l'effet
            setTimeout(() => {
                progressCircle.style.strokeDashoffset = offset;
            }, 500);
            
            // Animation des cartes au scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);
            
            // Observer les cartes
            document.querySelectorAll('.glass-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                observer.observe(card);
            });
            
            // Gestion du hover sur les boutons sociaux
            document.querySelectorAll('.social-btn').forEach(btn => {
                btn.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px) scale(1.02)';
                });
                btn.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        });
        
        // Mise à jour de la date en temps réel
        function updateDateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            const dateTimeString = now.toLocaleDateString('fr-FR', options);
            
            // Mettre à jour l'affichage si l'élément existe
            const dateElement = document.querySelector('.date-time');
            if (dateElement) {
                dateElement.textContent = dateTimeString;
            }
        }
        
        // Mettre à jour la date toutes les minutes
        setInterval(updateDateTime, 60000);
        updateDateTime(); // Appel initial
    </script>
</body>
</html>