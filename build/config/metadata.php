<?php
/**
 * Configuration des métadonnées du site
 * Charge les données depuis le fichier metadata.json
 */

class Metadata {
    private static $metadata = null;
    
    /**
     * Charge les métadonnées depuis le fichier JSON
     */
    public static function load() {
        if (self::$metadata === null) {
            $metadataPath = __DIR__ . '/../../deploy/metadata.json';
            if (file_exists($metadataPath)) {
                $jsonContent = file_get_contents($metadataPath);
                self::$metadata = json_decode($jsonContent, true);
            } else {
                // Métadonnées par défaut si le fichier n'existe pas
                self::$metadata = [
                    'site' => [
                        'name' => 'QuickPay',
                        'description' => 'Instant online payments for modern businesses. Secure, fast, and reliable payment processing.',
                        'logo' => '/assets/img/logo.svg',
                        'copyright' => '2025 QuickPay Inc.'
                    ],
                    'navigation' => [
                        'main' => [
                            ['link' => '/', 'title' => 'Home'],
                            ['link' => '/search.php', 'title' => 'Transaction Search'],
                            ['link' => '/dashboard.php', 'title' => 'Dashboard']
                        ],
                        'auth' => [
                            ['link' => '/login.php', 'title' => 'Login'],
                            ['link' => '/register.php', 'title' => 'Register']
                        ]
                    ],
                    'footer' => [
                        'links' => [
                            ['link' => '/', 'title' => 'Home'],
                            ['link' => '/search.php', 'title' => 'Search'],
                            ['link' => '/dashboard.php', 'title' => 'Dashboard']
                        ],
                        'social' => [
                            [
                                'name' => 'Website',
                                'href' => 'https://www.quickpay.com',
                                'icon' => 'website'
                            ],
                            [
                                'name' => 'GitHub',
                                'href' => 'https://github.com/quickpay',
                                'icon' => 'github'
                            ]
                        ]
                    ],
                    'cta' => [
                        'label' => 'Search Transactions',
                        'link' => '/search.php'
                    ]
                ];
            }
        }
        return self::$metadata;
    }
    
    /**
     * Récupère une valeur spécifique des métadonnées
     */
    public static function get($key, $default = null) {
        $metadata = self::load();
        $keys = explode('.', $key);
        $value = $metadata;
        
        foreach ($keys as $k) {
            if (isset($value[$k])) {
                $value = $value[$k];
            } else {
                return $default;
            }
        }
        
        return $value;
    }
    
    /**
     * Récupère toutes les métadonnées
     */
    public static function getAll() {
        return self::load();
    }
} 