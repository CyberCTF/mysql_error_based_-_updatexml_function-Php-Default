<?php
require_once __DIR__ . '/../Component.php';

class Dialog extends Component {
    public function render() {
        $open = $this->props['open'] ?? false;
        
        $classes = $this->cn(
            'relative z-50',
            $this->className
        );
        
        $attributes = $this->getAttributes(['open']);
        
        if (!$open) {
            return '';
        }
        
        return sprintf(
            '<div class="%s" %s>%s</div>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class DialogTrigger extends Component {
    public function render() {
        $classes = $this->cn(
            'inline-flex',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<button class="%s" type="button" %s>%s</button>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class DialogContent extends Component {
    public function render() {
        $classes = $this->cn(
            'fixed left-[50%] top-[50%] z-50 grid w-full max-w-lg translate-x-[-50%] translate-y-[-50%] gap-4 border border-slate-200 bg-white p-6 shadow-lg duration-200 data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 data-[state=closed]:slide-out-to-left-1/2 data-[state=closed]:slide-out-to-top-[48%] data-[state=open]:slide-in-from-left-1/2 data-[state=open]:slide-in-from-top-[48%] sm:rounded-lg md:w-full dark:border-slate-800 dark:bg-slate-950',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<div class="fixed inset-0 z-50 bg-black/80 data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0"></div>
            <div class="%s" %s>%s</div>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class DialogHeader extends Component {
    public function render() {
        $classes = $this->cn(
            'flex flex-col space-y-1.5 text-center sm:text-left',
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

class DialogTitle extends Component {
    public function render() {
        $classes = $this->cn(
            'text-lg font-semibold leading-none tracking-tight',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        $tag = $this->props['as'] ?? 'h2';
        
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

class DialogDescription extends Component {
    public function render() {
        $classes = $this->cn(
            'text-sm text-slate-500 dark:text-slate-400',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<p class="%s" %s>%s</p>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class DialogFooter extends Component {
    public function render() {
        $classes = $this->cn(
            'flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2',
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

// Enregistrer les composants
ComponentManager::register('Dialog', 'Dialog');
ComponentManager::register('DialogTrigger', 'DialogTrigger');
ComponentManager::register('DialogContent', 'DialogContent');
ComponentManager::register('DialogHeader', 'DialogHeader');
ComponentManager::register('DialogTitle', 'DialogTitle');
ComponentManager::register('DialogDescription', 'DialogDescription');
ComponentManager::register('DialogFooter', 'DialogFooter'); 