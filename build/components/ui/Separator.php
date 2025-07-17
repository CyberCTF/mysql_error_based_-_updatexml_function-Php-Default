<?php
require_once __DIR__ . '/../Component.php';

class Separator extends Component {
    public function render() {
        $orientation = $this->props['orientation'] ?? 'horizontal';
        $decorative = $this->props['decorative'] ?? true;
        
        $classes = $this->cn(
            'shrink-0 bg-slate-200 dark:bg-slate-800',
            $orientation === 'horizontal' ? 'h-[1px] w-full' : 'h-full w-[1px]',
            $this->className
        );
        
        $attributes = $this->getAttributes(['orientation', 'decorative']);
        
        return sprintf(
            '<div class="%s" role="%s" data-orientation="%s" %s></div>',
            $classes,
            $decorative ? 'none' : 'separator',
            $this->escape($orientation),
            $attributes
        );
    }
}

// Enregistrer le composant
ComponentManager::register('Separator', 'Separator'); 