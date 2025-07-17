<?php
require_once __DIR__ . '/../Component.php';

class Button extends Component {
    protected $variants = [
        'base' => 'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:ring-2 focus-visible:ring-offset-2',
        'variants' => [
            'default' => 'bg-slate-900 text-white shadow hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100',
            'destructive' => 'bg-red-500 text-white shadow hover:bg-red-600',
            'outline' => 'border border-slate-200 bg-white shadow-sm hover:bg-slate-100 hover:text-slate-900 dark:border-slate-800 dark:bg-slate-950 dark:hover:bg-slate-800 dark:hover:text-slate-50',
            'secondary' => 'bg-slate-100 text-slate-900 shadow-sm hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-50 dark:hover:bg-slate-700',
            'ghost' => 'hover:bg-slate-100 hover:text-slate-900 dark:hover:bg-slate-800 dark:hover:text-slate-50',
            'link' => 'text-slate-900 underline-offset-4 hover:underline dark:text-slate-50'
        ],
        'sizes' => [
            'default' => 'h-9 px-4 py-2',
            'sm' => 'h-8 rounded-md px-3',
            'lg' => 'h-10 rounded-md px-6',
            'icon' => 'h-9 w-9'
        ]
    ];

    protected $defaultVariants = [
        'variant' => 'default',
        'size' => 'default'
    ];

    public function render() {
        $variant = $this->props['variant'] ?? 'default';
        $size = $this->props['size'] ?? 'default';
        $asChild = $this->props['asChild'] ?? false;
        $type = $this->props['type'] ?? 'button';
        $href = $this->props['href'] ?? null;
        
        $classes = $this->cn(
            $this->getVariantClasses($variant, $size),
            $this->className
        );
        
        $attributes = $this->getAttributes(['asChild', 'variant', 'size', 'href']);
        
        if ($href || $asChild === 'a') {
            return sprintf(
                '<a href="%s" class="%s" %s>%s</a>',
                $this->escape($href ?? '#'),
                $classes,
                $attributes,
                $this->children
            );
        }
        
        return sprintf(
            '<button type="%s" class="%s" %s>%s</button>',
            $this->escape($type),
            $classes,
            $attributes,
            $this->children
        );
    }
}

// Enregistrer le composant
ComponentManager::register('Button', 'Button'); 