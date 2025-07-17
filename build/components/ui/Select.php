<?php
require_once __DIR__ . '/../Component.php';

class Select extends Component {
    public function render() {
        $name = $this->props['name'] ?? '';
        $value = $this->props['value'] ?? '';
        $disabled = $this->props['disabled'] ?? false;
        
        $classes = $this->cn(
            'relative',
            $this->className
        );
        
        $attributes = $this->getAttributes(['name', 'value', 'disabled']);
        
        return sprintf(
            '<div class="%s" %s>%s</div>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class SelectTrigger extends Component {
    public function render() {
        $classes = $this->cn(
            'flex h-9 w-full items-center justify-between rounded-md border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm ring-offset-white placeholder:text-slate-500 focus:outline-none focus:ring-1 focus:ring-slate-950 disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-800 dark:bg-slate-950 dark:ring-offset-slate-950 dark:placeholder:text-slate-400 dark:focus:ring-slate-300',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<button class="%s" type="button" %s>%s<svg class="h-4 w-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class SelectContent extends Component {
    public function render() {
        $classes = $this->cn(
            'relative z-50 min-w-[8rem] overflow-hidden rounded-md border border-slate-200 bg-white text-slate-950 shadow-md data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 data-[side=bottom]:slide-in-from-top-2 data-[side=left]:slide-in-from-right-2 data-[side=right]:slide-in-from-left-2 data-[side=top]:slide-in-from-bottom-2 dark:border-slate-800 dark:bg-slate-950 dark:text-slate-50',
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

class SelectItem extends Component {
    public function render() {
        $value = $this->props['value'] ?? '';
        
        $classes = $this->cn(
            'relative flex w-full cursor-default select-none items-center rounded-sm py-1.5 pl-2 pr-8 text-sm outline-none focus:bg-slate-100 focus:text-slate-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50 dark:focus:bg-slate-800 dark:focus:text-slate-50',
            $this->className
        );
        
        $attributes = $this->getAttributes(['value']);
        
        return sprintf(
            '<div class="%s" data-value="%s" %s>%s</div>',
            $classes,
            $this->escape($value),
            $attributes,
            $this->children
        );
    }
}

class SelectValue extends Component {
    public function render() {
        $placeholder = $this->props['placeholder'] ?? '';
        
        $classes = $this->cn(
            'text-sm',
            $this->className
        );
        
        return sprintf(
            '<span class="%s" data-placeholder="%s">%s</span>',
            $classes,
            $this->escape($placeholder),
            $this->children ?: $placeholder
        );
    }
}

// Enregistrer les composants
ComponentManager::register('Select', 'Select');
ComponentManager::register('SelectTrigger', 'SelectTrigger');
ComponentManager::register('SelectContent', 'SelectContent');
ComponentManager::register('SelectItem', 'SelectItem');
ComponentManager::register('SelectValue', 'SelectValue'); 