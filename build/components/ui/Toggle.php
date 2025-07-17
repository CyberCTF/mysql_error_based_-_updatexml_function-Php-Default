<?php
require_once __DIR__ . '/../Component.php';

class Toggle extends Component {
    public function render() {
        $pressed = $this->props['pressed'] ?? false;
        $disabled = $this->props['disabled'] ?? false;
        $variant = $this->props['variant'] ?? 'default';
        $size = $this->props['size'] ?? 'default';
        
        $baseClasses = 'inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors hover:bg-slate-100 hover:text-slate-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-slate-950 disabled:pointer-events-none disabled:opacity-50 data-[state=on]:bg-slate-100 data-[state=on]:text-slate-900 dark:hover:bg-slate-800 dark:hover:text-slate-400 dark:focus-visible:ring-slate-300 dark:data-[state=on]:bg-slate-800 dark:data-[state=on]:text-slate-50';
        
        $variantClasses = [
            'default' => 'bg-transparent',
            'outline' => 'border border-slate-200 bg-transparent shadow-sm hover:bg-slate-100 hover:text-slate-900 dark:border-slate-800 dark:hover:bg-slate-800 dark:hover:text-slate-50'
        ];
        
        $sizeClasses = [
            'default' => 'h-9 px-3',
            'sm' => 'h-8 px-2',
            'lg' => 'h-10 px-3'
        ];
        
        $classes = $this->cn(
            $baseClasses,
            $variantClasses[$variant] ?? $variantClasses['default'],
            $sizeClasses[$size] ?? $sizeClasses['default'],
            $this->className
        );
        
        $attributes = $this->getAttributes(['pressed', 'disabled', 'variant', 'size']);
        
        return sprintf(
            '<button class="%s" type="button" role="button" aria-pressed="%s" data-state="%s" %s %s %s>%s</button>',
            $classes,
            $pressed ? 'true' : 'false',
            $pressed ? 'on' : 'off',
            $disabled ? 'disabled' : '',
            $attributes,
            $disabled ? 'aria-disabled="true"' : '',
            $this->children
        );
    }
}

ComponentManager::register('Toggle', 'Toggle'); 