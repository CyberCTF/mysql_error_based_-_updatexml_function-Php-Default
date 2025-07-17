<?php
require_once __DIR__ . '/config/metadata.php';
require_once __DIR__ . '/config/database.php';

$metadata = Metadata::getAll();
$site = $metadata['site'];
$navigation = $metadata['navigation'];
$footer = $metadata['footer'];

$transactions = [];
$error = '';
$success = '';

// Handle search form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['query'])) {
    $query = trim($_POST['query']);
    
    if (!empty($query)) {
        try {
            $pdo = Database::getConnection();
            
            // VULNERABLE: Direct string concatenation without proper sanitization
            // This is intentionally vulnerable for educational purposes
            $sql = "SELECT id, transaction_id, amount, currency, status, created_at, merchant_name 
                    FROM transactions 
                    WHERE transaction_id LIKE '%" . $query . "%' 
                    OR merchant_name LIKE '%" . $query . "%' 
                    OR status LIKE '%" . $query . "%'
                    ORDER BY created_at DESC 
                    LIMIT 50";
            
            $stmt = $pdo->query($sql);
            $transactions = $stmt->fetchAll();
            
            if (count($transactions) > 0) {
                $success = "Found " . count($transactions) . " transaction(s) matching your search.";
            } else {
                $error = "No transactions found matching your search criteria.";
            }
            
        } catch (PDOException $e) {
            // Display the error message (this is part of the vulnerability)
            $error = "Database error: " . $e->getMessage();
        }
    } else {
        $error = "Please enter a search term.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Search - <?php echo htmlspecialchars($site['name']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen">
    <!-- Navbar -->
    <nav class="bg-neutral-900 border-b border-neutral-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                            <span class="text-white text-lg font-bold">💳</span>
                        </div>
                        <span class="text-xl font-bold text-white"><?php echo htmlspecialchars($site['name']); ?></span>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <?php foreach ($navigation['main'] as $item): ?>
                        <a href="<?php echo htmlspecialchars($item['link']); ?>" 
                           class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            <?php echo htmlspecialchars($item['title']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">Transaction Search</h1>
            <p class="text-gray-400">Search through transaction records by ID, merchant name, or status.</p>
        </div>

        <!-- Search Form -->
        <div class="bg-neutral-900 rounded-lg border border-neutral-800 p-6 mb-8">
            <form method="POST" class="space-y-4">
                <div>
                    <label for="query" class="block text-sm font-medium text-gray-300 mb-2">
                        Search Transactions
                    </label>
                    <div class="flex gap-4">
                        <input type="text" 
                               id="query" 
                               name="query" 
                               value="<?php echo isset($_POST['query']) ? htmlspecialchars($_POST['query']) : ''; ?>"
                               placeholder="Enter transaction ID, merchant name, or status..."
                               class="flex-1 bg-neutral-800 border border-neutral-700 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <button type="submit" 
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Messages -->
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

        <!-- Results -->
        <?php if (!empty($transactions)): ?>
            <div class="bg-neutral-900 rounded-lg border border-neutral-800 overflow-hidden">
                <div class="px-6 py-4 border-b border-neutral-800">
                    <h2 class="text-lg font-semibold text-white">Search Results</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-neutral-800">
                        <thead class="bg-neutral-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Transaction ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Currency</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Merchant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-neutral-900 divide-y divide-neutral-800">
                            <?php foreach ($transactions as $transaction): ?>
                                <tr class="hover:bg-neutral-800">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        <?php echo htmlspecialchars($transaction['id']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white font-medium">
                                        <?php echo htmlspecialchars($transaction['transaction_id']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        <?php echo htmlspecialchars($transaction['amount']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        <?php echo htmlspecialchars($transaction['currency']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                            <?php echo $transaction['status'] === 'completed' ? 'bg-green-900 text-green-200' : 
                                                   ($transaction['status'] === 'pending' ? 'bg-yellow-900 text-yellow-200' : 'bg-red-900 text-red-200'); ?>">
                                            <?php echo htmlspecialchars($transaction['status']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        <?php echo htmlspecialchars($transaction['merchant_name']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        <?php echo htmlspecialchars($transaction['created_at']); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>

        <!-- Search Tips -->
        <div class="mt-8 bg-neutral-900 rounded-lg border border-neutral-800 p-6">
            <h3 class="text-lg font-semibold text-white mb-4">Search Tips</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-300">
                <div>
                    <h4 class="font-medium text-white mb-2">Search by Transaction ID</h4>
                    <p>Enter a transaction ID to find specific payments</p>
                </div>
                <div>
                    <h4 class="font-medium text-white mb-2">Search by Merchant</h4>
                    <p>Find all transactions from a specific merchant</p>
                </div>
                <div>
                    <h4 class="font-medium text-white mb-2">Search by Status</h4>
                    <p>Filter by completed, pending, or failed transactions</p>
                </div>
                <div>
                    <h4 class="font-medium text-white mb-2">Partial Matches</h4>
                    <p>Use partial terms to find multiple matching records</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-neutral-900 border-t border-neutral-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                            <span class="text-white text-lg font-bold">💳</span>
                        </div>
                        <span class="text-xl font-bold text-white"><?php echo htmlspecialchars($site['name']); ?></span>
                    </div>
                    <p class="text-gray-400 mb-4">Secure, fast, and reliable payment processing for modern businesses.</p>
                    <p class="text-gray-500 text-sm">Copyright &copy; <?php echo htmlspecialchars($site['copyright']); ?>. All rights reserved.</p>
                </div>
                
                <div>
                    <h3 class="text-white font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <?php foreach ($footer['links'] as $link): ?>
                            <li>
                                <a href="<?php echo htmlspecialchars($link['link']); ?>" 
                                   class="text-gray-400 hover:text-white transition-colors">
                                    <?php echo htmlspecialchars($link['title']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-white font-semibold mb-4">Connect</h3>
                    <ul class="space-y-2">
                        <?php foreach ($footer['social'] as $link): ?>
                            <li>
                                <a href="<?php echo htmlspecialchars($link['href']); ?>" 
                                   class="text-gray-400 hover:text-white transition-colors"
                                   target="_blank"
                                   rel="noopener noreferrer">
                                    <?php echo htmlspecialchars($link['name']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
</html> 