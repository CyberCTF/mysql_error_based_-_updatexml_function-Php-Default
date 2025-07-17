<?php
require_once __DIR__ . '/../Component.php';

class Tabs extends Component {
    public function render() {
        $defaultValue = $this->props['defaultValue'] ?? '';
        $orientation = $this->props['orientation'] ?? 'horizontal';
        
        $classes = $this->cn(
            'w-full',
            $this->className
        );
        
        $attributes = $this->getAttributes(['defaultValue', 'orientation']);
        
        return sprintf(
            '<div class="%s" data-orientation="%s" data-default-value="%s" %s>%s</div>',
            $classes,
            $this->escape($orientation),
            $this->escape($defaultValue),
            $attributes,
            $this->children
        );
    }
}

class TabsList extends Component {
    public function render() {
        $classes = $this->cn(
            'inline-flex h-9 items-center justify-center rounded-lg bg-slate-100 p-1 text-slate-500 dark:bg-slate-800 dark:text-slate-400',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<div class="%s" role="tablist" %s>%s</div>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class TabsTrigger extends Component {
    public function render() {
        $value = $this->props['value'] ?? '';
        $disabled = $this->props['disabled'] ?? false;
        
        $classes = $this->cn(
            'inline-flex items-center justify-center whitespace-nowrap rounded-md px-3 py-1 text-sm font-medium ring-offset-white transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 data-[state=active]:bg-white data-[state=active]:text-slate-950 data-[state=active]:shadow dark:ring-offset-slate-950 dark:focus-visible:ring-slate-300 dark:data-[state=active]:bg-slate-950 dark:data-[state=active]:text-slate-50',
            $this->className
        );
        
        $attributes = $this->getAttributes(['value', 'disabled']);
        
        return sprintf(
            '<button class="%s" role="tab" data-value="%s" %s %s %s>%s</button>',
            $classes,
            $this->escape($value),
            $disabled ? 'disabled' : '',
            $attributes,
            $disabled ? 'aria-disabled="true"' : '',
            $this->children
        );
    }
}

class TabsContent extends Component {
    public function render() {
        $value = $this->props['value'] ?? '';
        
        $classes = $this->cn(
            'mt-2 ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 dark:ring-offset-slate-950 dark:focus-visible:ring-slate-300',
            $this->className
        );
        
        $attributes = $this->getAttributes(['value']);
        
        return sprintf(
            '<div class="%s" role="tabpanel" data-value="%s" %s>%s</div>',
            $classes,
            $this->escape($value),
            $attributes,
            $this->children
        );
    }
}

// Enregistrer les composants
ComponentManager::register('Tabs', 'Tabs');
ComponentManager::register('TabsList', 'TabsList');
ComponentManager::register('TabsTrigger', 'TabsTrigger');
ComponentManager::register('TabsContent', 'TabsContent'); 