<?php
require_once __DIR__ . '/../Component.php';

class Skeleton extends Component {
    public function render() {
        $classes = $this->cn(
            'animate-pulse rounded-md bg-slate-100 dark:bg-slate-800',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<div class="%s" %s>%s</div>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

// Enregistrer le composant
ComponentManager::register('Skeleton', 'Skeleton'); 