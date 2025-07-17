<?php
require_once __DIR__ . '/../Component.php';

class Accordion extends Component {
    public function render() {
        $type = $this->props['type'] ?? 'single';
        $collapsible = $this->props['collapsible'] ?? false;
        
        $classes = $this->cn(
            'w-full',
            $this->className
        );
        
        $attributes = $this->getAttributes(['type', 'collapsible']);
        
        return sprintf(
            '<div class="%s" data-type="%s" data-collapsible="%s" %s>%s</div>',
            $classes,
            $this->escape($type),
            $collapsible ? 'true' : 'false',
            $attributes,
            $this->children
        );
    }
}

class AccordionItem extends Component {
    public function render() {
        $value = $this->props['value'] ?? '';
        
        $classes = $this->cn(
            'border-b border-slate-200 dark:border-slate-700',
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

class AccordionTrigger extends Component {
    public function render() {
        $classes = $this->cn(
            'flex flex-1 items-center justify-between py-4 text-sm font-medium transition-all hover:underline cursor-pointer [&[data-state=open]>svg]:rotate-180',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<button class="%s" type="button" %s>%s<svg class="h-4 w-4 shrink-0 text-slate-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class AccordionContent extends Component {
    public function render() {
        $classes = $this->cn(
            'overflow-hidden text-sm data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<div class="%s" %s><div class="pb-4 pt-0">%s</div></div>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

// Enregistrer les composants
ComponentManager::register('Accordion', 'Accordion');
ComponentManager::register('AccordionItem', 'AccordionItem');
ComponentManager::register('AccordionTrigger', 'AccordionTrigger');
ComponentManager::register('AccordionContent', 'AccordionContent'); 