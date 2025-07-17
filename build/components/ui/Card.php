<?php
require_once __DIR__ . '/../Component.php';

class Card extends Component {
    public function render() {
        $classes = $this->cn(
            'bg-white text-slate-950 flex flex-col gap-6 rounded-xl border border-slate-200 py-6 shadow-sm dark:bg-slate-950 dark:text-slate-50 dark:border-slate-800',
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

class CardHeader extends Component {
    public function render() {
        $classes = $this->cn(
            'grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6',
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

class CardTitle extends Component {
    public function render() {
        $classes = $this->cn(
            'leading-none font-semibold text-lg',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        $tag = $this->props['as'] ?? 'h3';
        
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

class CardDescription extends Component {
    public function render() {
        $classes = $this->cn(
            'text-slate-500 text-sm dark:text-slate-400',
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

class CardContent extends Component {
    public function render() {
        $classes = $this->cn(
            'px-6',
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

class CardFooter extends Component {
    public function render() {
        $classes = $this->cn(
            'flex items-center px-6',
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

class CardAction extends Component {
    public function render() {
        $classes = $this->cn(
            'col-start-2 row-span-2 row-start-1 self-start justify-self-end',
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
ComponentManager::register('Card', 'Card');
ComponentManager::register('CardHeader', 'CardHeader');
ComponentManager::register('CardTitle', 'CardTitle');
ComponentManager::register('CardDescription', 'CardDescription');
ComponentManager::register('CardContent', 'CardContent');
ComponentManager::register('CardFooter', 'CardFooter');
ComponentManager::register('CardAction', 'CardAction'); 