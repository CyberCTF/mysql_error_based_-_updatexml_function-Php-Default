<?php
require_once __DIR__ . '/../Component.php';

class Alert extends Component {
    protected $variants = [
        'base' => 'relative w-full rounded-lg border border-slate-200 px-4 py-3 text-sm dark:border-slate-800',
        'variants' => [
            'default' => 'bg-white text-slate-950 dark:bg-slate-950 dark:text-slate-50',
            'destructive' => 'border-red-500/50 text-red-500 dark:border-red-500 [&>svg]:text-red-500',
            'success' => 'border-green-500/50 text-green-600 dark:border-green-500 [&>svg]:text-green-600',
            'warning' => 'border-yellow-500/50 text-yellow-600 dark:border-yellow-500 [&>svg]:text-yellow-600',
            'info' => 'border-blue-500/50 text-blue-600 dark:border-blue-500 [&>svg]:text-blue-600'
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
            '<div class="%s" role="alert" %s>%s</div>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class AlertDescription extends Component {
    public function render() {
        $classes = $this->cn(
            'text-sm [&_p]:leading-relaxed',
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

class AlertTitle extends Component {
    public function render() {
        $classes = $this->cn(
            'mb-1 font-medium leading-none tracking-tight',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        $tag = $this->props['as'] ?? 'h5';
        
        return sprintf(
            '<%s class="%s" %s>%s</%s>',
            $tag,
            $classes,
            $attributes,
            $this->children,
            $tag
        );
    }
}

// Enregistrer les composants
ComponentManager::register('Alert', 'Alert');
ComponentManager::register('AlertDescription', 'AlertDescription');
ComponentManager::register('AlertTitle', 'AlertTitle'); 