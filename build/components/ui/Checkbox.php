<?php
require_once __DIR__ . '/../Component.php';

class Checkbox extends Component {
    public function render() {
        $checked = $this->props['checked'] ?? false;
        $disabled = $this->props['disabled'] ?? false;
        $name = $this->props['name'] ?? '';
        $value = $this->props['value'] ?? '';
        $id = $this->props['id'] ?? '';
        
        $classes = $this->cn(
            'peer h-4 w-4 shrink-0 rounded-sm border border-slate-200 shadow focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-slate-950 disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-slate-900 data-[state=checked]:text-slate-50 dark:border-slate-800 dark:focus-visible:ring-slate-300 dark:data-[state=checked]:bg-slate-50 dark:data-[state=checked]:text-slate-900',
            $this->className
        );
        
        $attributes = $this->getAttributes(['checked', 'disabled', 'name', 'value', 'id']);
        
        return sprintf(
            '<input type="checkbox" class="%s" id="%s" name="%s" value="%s" %s %s %s />',
            $classes,
            $this->escape($id),
            $this->escape($name),
            $this->escape($value),
            $checked ? 'checked' : '',
            $disabled ? 'disabled' : '',
            $attributes
        );
    }
}

// Enregistrer le composant
ComponentManager::register('Checkbox', 'Checkbox'); 