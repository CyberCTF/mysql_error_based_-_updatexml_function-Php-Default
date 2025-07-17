<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickPay - Instant Online Payments</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .text-balance {
            text-wrap: balance;
        }
        
        /* Background avec rectangles SVG 3D comme l'original */
        .hero-background {
            pointer-events: none;
            position: absolute;
            inset: 0;
            z-index: 0;
            height: 100%;
            width: 100%;
            overflow: hidden;
            perspective: 1000px;
            transform-style: preserve-3d;
        }
        
        .rectangles {
            pointer-events: none;
            position: absolute;
            inset: 0;
            z-index: 0;
            height: 100%;
            width: 100%;
            overflow: hidden;
        }
        
        .rectangles.top {
            transform: rotateX(45deg);
            mask-image: linear-gradient(to top, white, transparent);
            -webkit-mask-image: linear-gradient(to top, white, transparent);
        }
        
        .rectangles.bottom {
            transform: rotateX(-45deg);
            mask-image: linear-gradient(to bottom, white, transparent);
            -webkit-mask-image: linear-gradient(to bottom, white, transparent);
        }
        
        /* Pattern SVG pour les rectangles */
        .rectangles::before {
            content: '';
            position: absolute;
            inset: 0;
            height: 100%;
            width: 100%;
            background-size: 40px 40px;
            background-position: center;
            background-repeat: repeat;
        }
        
        /* Mode sombre uniquement */
        .rectangles::before {
            background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Crect width='40' height='40' x='0' y='0' stroke='rgba(255,255,255,0.15)' fill='none' /%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-black dark">
    <?php
    // Charger le système de composants
    require_once __DIR__ . '/components/ComponentLoader.php';
    
    // Charger tous les composants
    ComponentLoader::loadAll();
    
    // Créer une instance du loader
    $loader = new ComponentLoader();
    
    // Charger les métadonnées
    require_once __DIR__ . '/config/metadata.php';
    $metadata = Metadata::getAll();
    $site = $metadata['site'];
    $cta = $metadata['cta'];
    $navigation = $metadata['navigation'];
    $footer = $metadata['footer'];
    ?>
    
    <!-- Navbar -->
    <nav class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-[95%] lg:w-full max-w-7xl">
        <div class="w-full flex relative justify-between px-4 py-3 rounded-md transition duration-200 bg-transparent mx-auto">
            <div class="flex flex-row gap-2 items-center z-10">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                        <span class="text-white text-lg font-bold">💳</span>
                    </div>
                    <span class="text-xl font-bold text-white"><?php echo htmlspecialchars($site['name']); ?></span>
                </div>
                
                <!-- Navigation principale -->
                <div class="flex items-center gap-1.5">
                    <?php foreach ($navigation['main'] as $item): ?>
                        <a href="<?php echo htmlspecialchars($item['link']); ?>" 
                           class="text-white hover:text-gray-300 transition-colors px-3 py-2 rounded-md text-sm">
                            <?php echo htmlspecialchars($item['title']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Navigation auth -->
            <div class="flex items-center gap-2">
                <?php foreach ($navigation['auth'] as $item): ?>
                    <a href="<?php echo htmlspecialchars($item['link']); ?>" 
                       class="text-white hover:text-gray-300 transition-colors px-3 py-2 rounded-md text-sm border border-neutral-700 hover:border-neutral-600">
                        <?php echo htmlspecialchars($item['title']); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="flex h-screen flex-col items-center justify-center border-b border-neutral-800">
        <!-- Background avec rectangles SVG 3D -->
        <div class="hero-background">
            <div class="rectangles top"></div>
            <div class="rectangles bottom"></div>
        </div>
        
        <!-- Contenu principal -->
        <div class="relative z-10">
            <h1 class="text-balance mx-auto max-w-2xl text-center text-3xl font-bold text-white md:text-5xl">
                <?php echo htmlspecialchars($site['name']); ?>
            </h1>
            <p class="text-balance mx-auto mt-4 max-w-2xl text-center text-base text-neutral-200">
                <?php echo htmlspecialchars($site['description']); ?>
            </p>
            <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="<?php echo htmlspecialchars($cta['link']); ?>" 
                   class="w-40 rounded-lg px-4 py-2 text-sm text-center bg-green-600 text-white border border-green-600 shadow hover:bg-green-700 transition-colors">
                    <?php echo htmlspecialchars($cta['label']); ?>
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-20 px-8">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold text-white text-center mb-12">Why Choose QuickPay?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-neutral-900 p-6 rounded-lg border border-neutral-800">
                    <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-white text-xl">⚡</span>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Instant Processing</h3>
                    <p class="text-neutral-300">Lightning-fast payment processing with real-time confirmations.</p>
                </div>
                <div class="bg-neutral-900 p-6 rounded-lg border border-neutral-800">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-white text-xl">🔒</span>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Secure Transactions</h3>
                    <p class="text-neutral-300">Bank-level security with end-to-end encryption for all transactions.</p>
                </div>
                <div class="bg-neutral-900 p-6 rounded-lg border border-neutral-800">
                    <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-white text-xl">📊</span>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Advanced Analytics</h3>
                    <p class="text-neutral-300">Comprehensive reporting and analytics for your business insights.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="relative">
        <div class="border-t border-neutral-900 px-8 pt-20 pb-32 relative">
            <div class="max-w-7xl mx-auto text-sm text-neutral-500 flex flex-row justify-between items-start gap-12">
                <div>
                    <div class="mr-4 md:flex mb-4">
                        <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                            <span class="text-white text-xl font-bold">💳</span>
                        </div>
                    </div>
                    <div>Copyright &copy; <?php echo htmlspecialchars($site['copyright']); ?></div>
                    <div class="mt-2">All rights reserved</div>
                </div>
                
                <div class="flex flex-row gap-12">
                    <div class="flex flex-col space-y-2 min-w-[120px]">
                        <h3 class="text-white font-semibold">Links</h3>
                        <?php foreach ($footer['links'] as $link): ?>
                            <a href="<?php echo htmlspecialchars($link['link']); ?>" 
                               class="text-neutral-400 hover:text-white transition-colors">
                                <?php echo htmlspecialchars($link['title']); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="flex flex-col space-y-2 min-w-[120px]">
                        <h3 class="text-white font-semibold">Social</h3>
                        <?php foreach ($footer['social'] as $link): ?>
                            <a href="<?php echo htmlspecialchars($link['href']); ?>" 
                               class="text-neutral-400 hover:text-white transition-colors"
                               target="_blank"
                               rel="noopener noreferrer">
                                <?php echo htmlspecialchars($link['name']); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 