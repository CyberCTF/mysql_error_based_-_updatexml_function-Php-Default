<?php
require_once __DIR__ . '/../Component.php';

class Progress extends Component {
    public function render() {
        $value = $this->props['value'] ?? 0;
        $max = $this->props['max'] ?? 100;
        
        $percentage = ($value / $max) * 100;
        
        $classes = $this->cn(
            'relative h-2 w-full overflow-hidden rounded-full bg-slate-100 dark:bg-slate-800',
            $this->className
        );
        
        $attributes = $this->getAttributes(['value', 'max']);
        
        return sprintf(
            '<div class="%s" role="progressbar" aria-valuenow="%s" aria-valuemax="%s" %s>
                <div class="h-full w-full flex-1 bg-slate-900 transition-all dark:bg-slate-50" style="transform: translateX(-%s%%)"></div>
            </div>',
            $classes,
            $this->escape($value),
            $this->escape($max),
            $attributes,
            100 - $percentage
        );
    }
}

// Enregistrer le composant
ComponentManager::register('Progress', 'Progress'); 