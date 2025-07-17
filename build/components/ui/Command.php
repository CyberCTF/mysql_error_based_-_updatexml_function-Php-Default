<?php
require_once __DIR__ . '/../Component.php';

class Command extends Component {
    public function render() {
        $classes = $this->cn(
            'flex h-full w-full flex-col overflow-hidden rounded-md bg-white text-slate-950 dark:bg-slate-950 dark:text-slate-50',
            $this->className
        );
        
        return sprintf('<div class="%s">%s</div>', $classes, $this->children);
    }
}

class CommandInput extends Component {
    public function render() {
        $placeholder = $this->props['placeholder'] ?? 'Type a command or search...';
        
        $classes = $this->cn(
            'flex h-10 w-full rounded-md bg-transparent py-3 text-sm outline-none placeholder:text-slate-500 disabled:cursor-not-allowed disabled:opacity-50 dark:placeholder:text-slate-400',
            $this->className
        );
        
        return sprintf(
            '<input class="%s" placeholder="%s" />',
            $classes,
            $this->escape($placeholder)
        );
    }
}

class CommandList extends Component {
    public function render() {
        $classes = $this->cn(
            'max-h-[300px] overflow-y-auto overflow-x-hidden',
            $this->className
        );
        
        return sprintf('<div class="%s">%s</div>', $classes, $this->children);
    }
}

class CommandEmpty extends Component {
    public function render() {
        $classes = $this->cn(
            'py-6 text-center text-sm',
            $this->className
        );
        
        return sprintf('<div class="%s">%s</div>', $classes, $this->children ?: 'No results found.');
    }
}

class CommandGroup extends Component {
    public function render() {
        $classes = $this->cn(
            'overflow-hidden p-1 text-slate-950 dark:text-slate-50',
            $this->className
        );
        
        return sprintf('<div class="%s">%s</div>', $classes, $this->children);
    }
}

class CommandItem extends Component {
    public function render() {
        $classes = $this->cn(
            'relative flex cursor-default select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none aria-selected:bg-slate-100 aria-selected:text-slate-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50 dark:aria-selected:bg-slate-800 dark:aria-selected:text-slate-50',
            $this->className
        );
        
        return sprintf('<div class="%s">%s</div>', $classes, $this->children);
    }
}

ComponentManager::register('Command', 'Command');
ComponentManager::register('CommandInput', 'CommandInput');
ComponentManager::register('CommandList', 'CommandList');
ComponentManager::register('CommandEmpty', 'CommandEmpty');
ComponentManager::register('CommandGroup', 'CommandGroup');
ComponentManager::register('CommandItem', 'CommandItem'); 