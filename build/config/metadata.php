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
                        'name' => 'CyberCTF Library',
                        'description' => 'A Capture The Flag platform for security challenges',
                        'logo' => '/assets/img/logo.svg',
                        'copyright' => '2025 Cyber CTF'
                    ],
                    'navigation' => [
                        'main' => [
                            ['link' => '/', 'title' => 'Home']
                        ],
                        'auth' => [
                            ['link' => '/login', 'title' => 'Login'],
                            ['link' => '/register', 'title' => 'Register']
                        ]
                    ],
                    'footer' => [
                        'links' => [
                            ['link' => '/', 'title' => 'Home']
                        ],
                        'social' => [
                            [
                                'name' => 'Website',
                                'href' => 'https://www.cyberctf.fr',
                                'icon' => 'website'
                            ],
                            [
                                'name' => 'GitHub',
                                'href' => 'https://github.com/cyberctf',
                                'icon' => 'github'
                            ]
                        ]
                    ],
                    'challenge' => [
                        'title' => 'Database Security Challenge',
                        'description' => 'Find and exploit the SQL injection vulnerability in the login form. Use your knowledge of database security to bypass authentication.',
                        'skills' => ['SQL', 'Security', 'Web', 'Authentication'],
                        'points' => 160
                    ],
                    'cta' => [
                        'label' => 'Start the lab',
                        'link' => '/lab'
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