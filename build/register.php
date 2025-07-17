<?php
require_once __DIR__ . '/config/metadata.php';
require_once __DIR__ . '/config/database.php';

$metadata = Metadata::getAll();
$site = $metadata['site'];
$navigation = $metadata['navigation'];
$footer = $metadata['footer'];

$error = '';
$success = '';

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    if (!empty($username) && !empty($email) && !empty($password)) {
        try {
            $pdo = Database::getConnection();
            
            // Simple registration (for demo purposes)
            $success = "Registration successful! You can now login with your credentials.";
            
        } catch (PDOException $e) {
            $error = "Database connection error.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - <?php echo htmlspecialchars($site['name']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-auto p-6">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-green-500 rounded-lg flex items-center justify-center mx-auto mb-4">
                <span class="text-white text-2xl font-bold">💳</span>
            </div>
            <h1 class="text-2xl font-bold text-white"><?php echo htmlspecialchars($site['name']); ?></h1>
            <p class="text-gray-400 mt-2">Create your account</p>
        </div>

        <!-- Registration Form -->
        <div class="bg-neutral-900 rounded-lg border border-neutral-800 p-6">
            <?php if ($error): ?>
                <div class="bg-red-900 border border-red-700 text-red-200 px-4 py-3 rounded-lg mb-6">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="bg-green-900 border border-green-700 text-green-200 px-4 py-3 rounded-lg mb-6">
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-4">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-300 mb-2">
                        Username
                    </label>
                    <input type="text" 
                           id="username" 
                           name="username" 
                           value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                           class="w-full bg-neutral-800 border border-neutral-700 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                           placeholder="Choose a username"
                           required>
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                        Email
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                           class="w-full bg-neutral-800 border border-neutral-700 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                           placeholder="Enter your email"
                           required>
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                        Password
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="w-full bg-neutral-800 border border-neutral-700 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                           placeholder="Choose a password"
                           required>
                </div>
                
                <button type="submit" 
                        class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg font-medium transition-colors">
                    Create Account
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <p class="text-gray-400 text-sm">
                    Already have an account? 
                    <a href="login.php" class="text-green-500 hover:text-green-400 transition-colors">
                        Sign in here
                    </a>
                </p>
            </div>
        </div>

        <!-- Navigation -->
        <div class="mt-6 text-center">
            <a href="/" class="text-green-500 hover:text-green-400 transition-colors">
                ← Back to Home
            </a>
        </div>
    </div>
</body>
</html> 