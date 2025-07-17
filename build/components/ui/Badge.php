<?php
require_once __DIR__ . '/../Component.php';

class Badge extends Component {
    protected $variants = [
        'base' => 'inline-flex items-center rounded-md border border-slate-200 px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-slate-950 focus:ring-offset-2 dark:border-slate-800 dark:focus:ring-slate-300',
        'variants' => [
            'default' => 'bg-slate-900 text-slate-50 shadow hover:bg-slate-900/80 dark:bg-slate-50 dark:text-slate-900 dark:hover:bg-slate-50/80',
            'secondary' => 'bg-slate-100 text-slate-900 hover:bg-slate-100/80 dark:bg-slate-800 dark:text-slate-50 dark:hover:bg-slate-800/80',
            'destructive' => 'bg-red-500 text-slate-50 shadow hover:bg-red-500/80 dark:bg-red-900 dark:text-slate-50 dark:hover:bg-red-900/80',
            'success' => 'bg-green-500 text-slate-50 shadow hover:bg-green-500/80 dark:bg-green-900 dark:text-slate-50 dark:hover:bg-green-900/80',
            'warning' => 'bg-yellow-500 text-slate-900 shadow hover:bg-yellow-500/80 dark:bg-yellow-900 dark:text-slate-50 dark:hover:bg-yellow-900/80',
            'outline' => 'text-slate-950 dark:text-slate-50',
            'skill' => 'bg-blue-100 text-blue-800 border-blue-200 dark:bg-blue-900 dark:text-blue-100 dark:border-blue-800'
        ]
    ];

    protected $defaultVariants = [
        'variant' => 'default'
    ];

    public function render() {
        $variant = $this->props['variant'] ?? 'default';
        
        $classes = $this->cn(
            $this->getVariantClasses($variant),
            $this->className
        );
        
        $attributes = $this->getAttributes(['variant']);
        
        return sprintf(
            '<span class="%s" %s>%s</span>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

// Enregistrer le composant
ComponentManager::register('Badge', 'Badge'); 