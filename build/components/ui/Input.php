<?php
require_once __DIR__ . '/../Component.php';

class Input extends Component {
    public function render() {
        $type = $this->props['type'] ?? 'text';
        $placeholder = $this->props['placeholder'] ?? '';
        $value = $this->props['value'] ?? '';
        $name = $this->props['name'] ?? '';
        $id = $this->props['id'] ?? '';
        $required = $this->props['required'] ?? false;
        $disabled = $this->props['disabled'] ?? false;
        
        $classes = $this->cn(
            'flex h-9 w-full rounded-md border border-slate-200 bg-white px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-slate-950 disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-800 dark:bg-slate-950 dark:placeholder:text-slate-400 dark:focus-visible:ring-slate-300',
            $this->className
        );
        
        $attributes = $this->getAttributes(['type', 'placeholder', 'value', 'name', 'id', 'required', 'disabled']);
        
        return sprintf(
            '<input type="%s" class="%s" placeholder="%s" value="%s" name="%s" id="%s" %s %s %s />',
            $this->escape($type),
            $classes,
            $this->escape($placeholder),
            $this->escape($value),
            $this->escape($name),
            $this->escape($id),
            $required ? 'required' : '',
            $disabled ? 'disabled' : '',
            $attributes
        );
    }
}

class Label extends Component {
    public function render() {
        $for = $this->props['for'] ?? $this->props['htmlFor'] ?? '';
        
        $classes = $this->cn(
            'text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70',
            $this->className
        );
        
        $attributes = $this->getAttributes(['for', 'htmlFor']);
        
        return sprintf(
            '<label for="%s" class="%s" %s>%s</label>',
            $this->escape($for),
            $classes,
            $attributes,
            $this->children
        );
    }
}

class Textarea extends Component {
    public function render() {
        $placeholder = $this->props['placeholder'] ?? '';
        $name = $this->props['name'] ?? '';
        $id = $this->props['id'] ?? '';
        $rows = $this->props['rows'] ?? 3;
        $required = $this->props['required'] ?? false;
        $disabled = $this->props['disabled'] ?? false;
        
        $classes = $this->cn(
            'flex min-h-[60px] w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-slate-950 disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-800 dark:bg-slate-950 dark:placeholder:text-slate-400 dark:focus-visible:ring-slate-300',
            $this->className
        );
        
        $attributes = $this->getAttributes(['placeholder', 'name', 'id', 'rows', 'required', 'disabled']);
        
        return sprintf(
            '<textarea class="%s" placeholder="%s" name="%s" id="%s" rows="%s" %s %s %s>%s</textarea>',
            $classes,
            $this->escape($placeholder),
            $this->escape($name),
            $this->escape($id),
            $this->escape($rows),
            $required ? 'required' : '',
            $disabled ? 'disabled' : '',
            $attributes,
            $this->escape($this->children)
        );
    }
}

// Enregistrer les composants
ComponentManager::register('Input', 'Input');
ComponentManager::register('Label', 'Label');
ComponentManager::register('Textarea', 'Textarea'); 