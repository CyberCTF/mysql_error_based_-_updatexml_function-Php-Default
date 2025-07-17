<?php
require_once __DIR__ . '/../Component.php';

class Avatar extends Component {
    public function render() {
        $classes = $this->cn(
            'relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<span class="%s" %s>%s</span>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class AvatarImage extends Component {
    public function render() {
        $src = $this->props['src'] ?? '';
        $alt = $this->props['alt'] ?? '';
        
        $classes = $this->cn(
            'aspect-square h-full w-full',
            $this->className
        );
        
        $attributes = $this->getAttributes(['src', 'alt']);
        
        return sprintf(
            '<img class="%s" src="%s" alt="%s" %s />',
            $classes,
            $this->escape($src),
            $this->escape($alt),
            $attributes
        );
    }
}

class AvatarFallback extends Component {
    public function render() {
        $classes = $this->cn(
            'flex h-full w-full items-center justify-center rounded-full bg-slate-100 dark:bg-slate-800',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<span class="%s" %s>%s</span>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

// Enregistrer les composants
ComponentManager::register('Avatar', 'Avatar');
ComponentManager::register('AvatarImage', 'AvatarImage');
ComponentManager::register('AvatarFallback', 'AvatarFallback'); 