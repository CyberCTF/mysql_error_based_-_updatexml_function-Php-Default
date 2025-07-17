<?php
require_once __DIR__ . '/Component.php';

/**
 * Chargeur et gestionnaire de composants
 */
class ComponentLoader {
    private static $loaded = [];
    
    /**
     * Charge automatiquement tous les composants
     */
    public static function loadAll() {
        self::loadDirectory(__DIR__ . '/ui');
        self::loadDirectory(__DIR__ . '/challenge');
    }
    
    /**
     * Charge tous les composants d'un répertoire
     */
    private static function loadDirectory($dir) {
        if (!is_dir($dir)) {
            return;
        }
        
        $files = scandir($dir);
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                $path = $dir . '/' . $file;
                if (!in_array($path, self::$loaded)) {
                    require_once $path;
                    self::$loaded[] = $path;
                }
            }
        }
    }
    
    /**
     * Charge un composant spécifique
     */
    public static function load($component) {
        $paths = [
            __DIR__ . '/ui/' . $component . '.php',
            __DIR__ . '/challenge/' . $component . '.php',
            __DIR__ . '/' . $component . '.php'
        ];
        
        foreach ($paths as $path) {
            if (file_exists($path) && !in_array($path, self::$loaded)) {
                require_once $path;
                self::$loaded[] = $path;
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Rendre un composant avec des props et contenu
     */
    public function render($componentName, $props = [], $children = '') {
        // Essayer de charger le composant s'il n'existe pas
        if (!class_exists($componentName)) {
            self::load($componentName);
        }
        
        // Vérifier si le composant existe maintenant
        if (!class_exists($componentName)) {
            return "<!-- Erreur: Composant '$componentName' non trouvé -->";
        }
        
        try {
            $component = new $componentName();
            $component->setProps($props);
            $component->setChildren($children);
            return $component->render();
        } catch (Exception $e) {
            return "<!-- Erreur lors du rendu de '$componentName': " . $e->getMessage() . " -->";
        }
    }
    
    /**
     * Vérifie si un composant est chargé
     */
    public static function isLoaded($component) {
        return class_exists($component);
    }
} 