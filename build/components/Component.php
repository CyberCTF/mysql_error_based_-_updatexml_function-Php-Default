<?php

/**
 * Classe de base pour tous les composants PHP
 * Inspirée du système shadcn/ui avec gestion des variantes
 */
abstract class Component {
    protected $props = [];
    protected $children = '';
    protected $className = '';
    protected $variants = [];
    protected $defaultVariants = [];

    public function __construct($props = []) {
        $this->props = $props;
        $this->className = $props['className'] ?? '';
        $this->children = $props['children'] ?? '';
    }
    
    /**
     * Définit les propriétés du composant
     */
    public function setProps($props) {
        $this->props = array_merge($this->props, $props);
        $this->className = $this->props['className'] ?? '';
    }
    
    /**
     * Définit le contenu enfant du composant
     */
    public function setChildren($children) {
        $this->children = $children;
    }

    /**
     * Méthode principale pour rendre le composant
     */
    abstract public function render();

    /**
     * Combine les classes CSS avec gestion des variantes
     */
    protected function cn(...$classes) {
        $result = [];
        
        foreach ($classes as $class) {
            if (is_string($class) && !empty($class)) {
                $result[] = $class;
            } elseif (is_array($class)) {
                $result = array_merge($result, array_filter($class));
            }
        }
        
        return implode(' ', array_unique(array_filter($result)));
    }

    /**
     * Génère les classes en fonction des variantes
     */
    protected function getVariantClasses($variant, $size = null) {
        $classes = [];
        
        // Classes de base
        if (isset($this->variants['base'])) {
            $classes[] = $this->variants['base'];
        }
        
        // Classes de variante
        if (isset($this->variants['variants'][$variant])) {
            $classes[] = $this->variants['variants'][$variant];
        } elseif (isset($this->defaultVariants['variant'])) {
            $classes[] = $this->variants['variants'][$this->defaultVariants['variant']];
        }
        
        // Classes de taille
        if ($size && isset($this->variants['sizes'][$size])) {
            $classes[] = $this->variants['sizes'][$size];
        } elseif (isset($this->defaultVariants['size'])) {
            $classes[] = $this->variants['sizes'][$this->defaultVariants['size']];
        }
        
        return implode(' ', $classes);
    }

    /**
     * Échappe les données pour éviter les injections XSS
     */
    protected function escape($data) {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Génère les attributs HTML
     */
    protected function getAttributes($exclude = []) {
        $attributes = [];
        $exclude = array_merge($exclude, ['children', 'className', 'variant', 'size']);
        
        foreach ($this->props as $key => $value) {
            if (!in_array($key, $exclude)) {
                if ($key === 'onClick') {
                    $attributes[] = 'onclick="' . $this->escape($value) . '"';
                } elseif ($key === 'onSubmit') {
                    $attributes[] = 'onsubmit="' . $this->escape($value) . '"';
                } elseif (is_bool($value)) {
                    if ($value) {
                        $attributes[] = $key;
                    }
                } else {
                    $attributes[] = $key . '="' . $this->escape($value) . '"';
                }
            }
        }
        
        return implode(' ', $attributes);
    }

    /**
     * Rendu statique d'un composant
     */
    public static function make($props = []) {
        $instance = new static($props);
        return $instance->render();
    }
}

/**
 * Gestionnaire de composants pour charger et rendre dynamiquement
 */
class ComponentManager {
    private static $components = [];
    
    public static function register($name, $className) {
        self::$components[$name] = $className;
    }
    
    public static function render($name, $props = []) {
        if (isset(self::$components[$name])) {
            $className = self::$components[$name];
            return $className::make($props);
        }
        
        throw new Exception("Composant '$name' non trouvé");
    }
    
    public static function load($componentPath) {
        if (file_exists($componentPath)) {
            require_once $componentPath;
        }
    }
}

/**
 * Fonction helper pour rendre rapidement un composant
 */
function component($name, $props = []) {
    return ComponentManager::render($name, $props);
}

/**
 * Fonction helper pour combiner les classes CSS
 */
function cn(...$classes) {
    $result = [];
    
    foreach ($classes as $class) {
        if (is_string($class) && !empty($class)) {
            $result[] = $class;
        } elseif (is_array($class)) {
            $result = array_merge($result, array_filter($class));
        }
    }
    
    return implode(' ', array_unique(array_filter($result)));
} 