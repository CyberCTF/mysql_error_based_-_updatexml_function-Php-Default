<?php
require_once __DIR__ . '/../Component.php';

class Breadcrumb extends Component {
    public function render() {
        $classes = $this->cn(
            'flex flex-wrap items-center gap-1.5 break-words text-sm text-slate-500 sm:gap-2.5 dark:text-slate-400',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<nav class="%s" aria-label="breadcrumb" %s>%s</nav>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class BreadcrumbList extends Component {
    public function render() {
        $classes = $this->cn(
            'flex flex-wrap items-center gap-1.5 sm:gap-2.5',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<ol class="%s" %s>%s</ol>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class BreadcrumbItem extends Component {
    public function render() {
        $classes = $this->cn(
            'inline-flex items-center gap-1.5',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<li class="%s" %s>%s</li>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class BreadcrumbLink extends Component {
    public function render() {
        $href = $this->props['href'] ?? '#';
        
        $classes = $this->cn(
            'transition-colors hover:text-slate-950 dark:hover:text-slate-50',
            $this->className
        );
        
        $attributes = $this->getAttributes(['href']);
        
        return sprintf(
            '<a class="%s" href="%s" %s>%s</a>',
            $classes,
            $this->escape($href),
            $attributes,
            $this->children
        );
    }
}

class BreadcrumbPage extends Component {
    public function render() {
        $classes = $this->cn(
            'font-normal text-slate-950 dark:text-slate-50',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<span class="%s" role="link" aria-disabled="true" aria-current="page" %s>%s</span>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class BreadcrumbSeparator extends Component {
    public function render() {
        $classes = $this->cn(
            '[&>svg]:size-3.5',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<li class="%s" role="presentation" aria-hidden="true" %s>%s</li>',
            $classes,
            $attributes,
            $this->children ?: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>'
        );
    }
}

class BreadcrumbEllipsis extends Component {
    public function render() {
        $classes = $this->cn(
            'flex h-9 w-9 items-center justify-center',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<span class="%s" role="presentation" aria-hidden="true" %s>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="1"></circle>
                    <circle cx="19" cy="12" r="1"></circle>
                    <circle cx="5" cy="12" r="1"></circle>
                </svg>
                <span class="sr-only">More</span>
            </span>',
            $classes,
            $attributes
        );
    }
}

// Enregistrer les composants
ComponentManager::register('Breadcrumb', 'Breadcrumb');
ComponentManager::register('BreadcrumbList', 'BreadcrumbList');
ComponentManager::register('BreadcrumbItem', 'BreadcrumbItem');
ComponentManager::register('BreadcrumbLink', 'BreadcrumbLink');
ComponentManager::register('BreadcrumbPage', 'BreadcrumbPage');
ComponentManager::register('BreadcrumbSeparator', 'BreadcrumbSeparator');
ComponentManager::register('BreadcrumbEllipsis', 'BreadcrumbEllipsis'); 