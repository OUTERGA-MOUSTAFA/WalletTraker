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


            <form action="/register" method="post">
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
                               placeholder="Enter your CIN"
                               value="<?= htmlspecialchars($_POST['cin'] ?? '') ?>"
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
                               placeholder="Choose a username"
                               value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
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
                               placeholder="example@email.com" 
                               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
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
                               placeholder="**********"
                               class="w-full px-4 py-3 pl-10 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <i class="fas fa-lock absolute left-3 top-3.5 text-gray-400"></i>
                        <button type="button" 
                                class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500">au moins 8 characters</p>
                </div>

                <!-- Confirm Password Field -->
                <div class="space-y-2">
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700">
                        Confirm Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="confirm_password" 
                               placeholder="**********"
                               class="w-full px-4 py-3 pl-10 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <i class="fas fa-lock absolute left-3 top-3.5 text-gray-400"></i>
                        <button type="button" 
                                class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600"
                                >
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <!-- Submit Button -->
                <button type="submit" name="register" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center gap-2 cursor-pointer">
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