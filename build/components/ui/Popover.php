<?php
require_once __DIR__ . '/../Component.php';

class Popover extends Component {
    public function render() {
        $classes = $this->cn('relative', $this->className);
        return sprintf('<div class="%s">%s</div>', $classes, $this->children);
    }
}

class PopoverTrigger extends Component {
    public function render() {
        $classes = $this->cn('inline-block', $this->className);
        return sprintf('<div class="%s">%s</div>', $classes, $this->children);
    }
}

class PopoverContent extends Component {
    public function render() {
        $side = $this->props['side'] ?? 'bottom';
        $align = $this->props['align'] ?? 'center';
        
        $classes = $this->cn(
            'z-50 w-72 rounded-md border border-slate-200 bg-white p-4 text-slate-950 shadow-md outline-none data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 data-[side=bottom]:slide-in-from-top-2 data-[side=left]:slide-in-from-right-2 data-[side=right]:slide-in-from-left-2 data-[side=top]:slide-in-from-bottom-2 dark:border-slate-800 dark:bg-slate-950 dark:text-slate-50',
            $this->className
        );
        
        return sprintf(
            '<div class="%s" data-side="%s" data-align="%s">%s</div>',
            $classes,
            $this->escape($side),
            $this->escape($align),
            $this->children
        );
    }
}

ComponentManager::register('Popover', 'Popover');
ComponentManager::register('PopoverTrigger', 'PopoverTrigger');
ComponentManager::register('PopoverContent', 'PopoverContent'); 