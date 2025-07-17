<?php
require_once __DIR__ . '/../Component.php';

class Tooltip extends Component {
    public function render() {
        $classes = $this->cn(
            'relative inline-block',
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

class TooltipTrigger extends Component {
    public function render() {
        $classes = $this->cn(
            'cursor-pointer',
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

class TooltipContent extends Component {
    public function render() {
        $side = $this->props['side'] ?? 'top';
        $align = $this->props['align'] ?? 'center';
        
        $classes = $this->cn(
            'z-50 overflow-hidden rounded-md bg-slate-900 px-3 py-1.5 text-xs text-slate-50 animate-in fade-in-0 zoom-in-95 data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=closed]:zoom-out-95 data-[side=bottom]:slide-in-from-top-2 data-[side=left]:slide-in-from-right-2 data-[side=right]:slide-in-from-left-2 data-[side=top]:slide-in-from-bottom-2 dark:bg-slate-50 dark:text-slate-900',
            $this->className
        );
        
        $attributes = $this->getAttributes(['side', 'align']);
        
        return sprintf(
            '<div class="absolute z-50 hidden group-hover:block" data-side="%s" data-align="%s">
                <div class="%s" %s>%s</div>
            </div>',
            $this->escape($side),
            $this->escape($align),
            $classes,
            $attributes,
            $this->children
        );
    }
}

// Enregistrer les composants
ComponentManager::register('Tooltip', 'Tooltip');
ComponentManager::register('TooltipTrigger', 'TooltipTrigger');
ComponentManager::register('TooltipContent', 'TooltipContent'); 