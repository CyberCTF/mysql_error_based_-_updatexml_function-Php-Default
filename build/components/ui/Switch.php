<?php
require_once __DIR__ . '/../Component.php';

class SwitchComponent extends Component {
    public function render() {
        $checked = $this->props['checked'] ?? false;
        $disabled = $this->props['disabled'] ?? false;
        $name = $this->props['name'] ?? '';
        $id = $this->props['id'] ?? '';
        
        $classes = $this->cn(
            'peer inline-flex h-5 w-9 shrink-0 cursor-pointer items-center rounded-full border-2 border-transparent shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 focus-visible:ring-offset-white disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-slate-900 data-[state=unchecked]:bg-slate-200 dark:focus-visible:ring-slate-300 dark:focus-visible:ring-offset-slate-950 dark:data-[state=checked]:bg-slate-50 dark:data-[state=unchecked]:bg-slate-800',
            $this->className
        );
        
        $attributes = $this->getAttributes(['checked', 'disabled', 'name', 'id']);
        
        return sprintf(
            '<button class="%s" role="switch" id="%s" name="%s" data-state="%s" %s %s %s>
                <span class="pointer-events-none block h-4 w-4 rounded-full bg-white shadow-lg ring-0 transition-transform data-[state=checked]:translate-x-4 data-[state=unchecked]:translate-x-0 dark:bg-slate-950" data-state="%s"></span>
            </button>',
            $classes,
            $this->escape($id),
            $this->escape($name),
            $checked ? 'checked' : 'unchecked',
            $disabled ? 'disabled' : '',
            $attributes,
            $disabled ? 'aria-disabled="true"' : '',
            $checked ? 'checked' : 'unchecked'
        );
    }
}

// Enregistrer le composant
ComponentManager::register('Switch', 'SwitchComponent'); 