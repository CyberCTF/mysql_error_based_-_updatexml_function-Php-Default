<?php
require_once __DIR__ . '/config/metadata.php';
require_once __DIR__ . '/config/database.php';

$metadata = Metadata::getAll();
$site = $metadata['site'];
$navigation = $metadata['navigation'];
$footer = $metadata['footer'];

$stats = [
    'total_transactions' => 0,
    'total_amount' => 0,
    'completed_transactions' => 0,
    'pending_transactions' => 0,
    'failed_transactions' => 0
];

$recent_transactions = [];

try {
    $pdo = Database::getConnection();
    
    // Get statistics
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM transactions");
    $stats['total_transactions'] = $stmt->fetch()['total'];
    
    $stmt = $pdo->query("SELECT SUM(amount) as total FROM transactions WHERE status = 'completed'");
    $result = $stmt->fetch();
    $stats['total_amount'] = $result['total'] ?? 0;
    
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM transactions WHERE status = 'completed'");
    $stats['completed_transactions'] = $stmt->fetch()['count'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM transactions WHERE status = 'pending'");
    $stats['pending_transactions'] = $stmt->fetch()['count'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM transactions WHERE status = 'failed'");
    $stats['failed_transactions'] = $stmt->fetch()['count'];
    
    // Get recent transactions
    $stmt = $pdo->query("SELECT id, transaction_id, amount, currency, status, created_at, merchant_name 
                        FROM transactions 
                        ORDER BY created_at DESC 
                        LIMIT 10");
    $recent_transactions = $stmt->fetchAll();
    
} catch (PDOException $e) {
    // Handle error silently for demo
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?php echo htmlspecialchars($site['name']); ?></title>
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
            <h1 class="text-3xl font-bold text-white mb-2">Dashboard</h1>
            <p class="text-gray-400">Overview of your payment processing activities.</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-neutral-900 rounded-lg border border-neutral-800 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center">
                        <span class="text-white text-xl">📊</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-400">Total Transactions</p>
                        <p class="text-2xl font-bold text-white"><?php echo number_format($stats['total_transactions']); ?></p>
                    </div>
                </div>
            </div>
            
            <div class="bg-neutral-900 rounded-lg border border-neutral-800 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                        <span class="text-white text-xl">💰</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-400">Total Amount</p>
                        <p class="text-2xl font-bold text-white">$<?php echo number_format($stats['total_amount'], 2); ?></p>
                    </div>
                </div>
            </div>
            
            <div class="bg-neutral-900 rounded-lg border border-neutral-800 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center">
                        <span class="text-white text-xl">✅</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-400">Completed</p>
                        <p class="text-2xl font-bold text-white"><?php echo number_format($stats['completed_transactions']); ?></p>
                    </div>
                </div>
            </div>
            
            <div class="bg-neutral-900 rounded-lg border border-neutral-800 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-yellow-600 rounded-lg flex items-center justify-center">
                        <span class="text-white text-xl">⏳</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-400">Pending</p>
                        <p class="text-2xl font-bold text-white"><?php echo number_format($stats['pending_transactions']); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-neutral-900 rounded-lg border border-neutral-800 overflow-hidden">
            <div class="px-6 py-4 border-b border-neutral-800">
                <h2 class="text-lg font-semibold text-white">Recent Transactions</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-neutral-800">
                    <thead class="bg-neutral-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Transaction ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Merchant</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-neutral-900 divide-y divide-neutral-800">
                        <?php if (!empty($recent_transactions)): ?>
                            <?php foreach ($recent_transactions as $transaction): ?>
                                <tr class="hover:bg-neutral-800">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white font-medium">
                                        <?php echo htmlspecialchars($transaction['transaction_id']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        <?php echo htmlspecialchars($transaction['currency']); ?> <?php echo htmlspecialchars($transaction['amount']); ?>
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
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-400">
                                    No transactions found
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-neutral-900 rounded-lg border border-neutral-800 p-6">
                <h3 class="text-lg font-semibold text-white mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="search.php" class="block w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-center transition-colors">
                        Search Transactions
                    </a>
                    <a href="#" class="block w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-center transition-colors">
                        Generate Report
                    </a>
                </div>
            </div>
            
            <div class="bg-neutral-900 rounded-lg border border-neutral-800 p-6">
                <h3 class="text-lg font-semibold text-white mb-4">System Status</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-300">Payment Processing</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-900 text-green-200">
                            Online
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-300">Database</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-900 text-green-200">
                            Connected
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-300">API Services</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-900 text-green-200">
                            Operational
                        </span>
                    </div>
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