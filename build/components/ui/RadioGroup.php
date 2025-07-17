<?php
require_once __DIR__ . '/../Component.php';

class RadioGroup extends Component {
    public function render() {
        $name = $this->props['name'] ?? '';
        $value = $this->props['value'] ?? '';
        $orientation = $this->props['orientation'] ?? 'vertical';
        
        $classes = $this->cn(
            'grid gap-2',
            $this->className
        );
        
        $attributes = $this->getAttributes(['name', 'value', 'orientation']);
        
        return sprintf(
            '<div class="%s" role="radiogroup" data-orientation="%s" %s>%s</div>',
            $classes,
            $this->escape($orientation),
            $attributes,
            $this->children
        );
    }
}

class RadioGroupItem extends Component {
    public function render() {
        $value = $this->props['value'] ?? '';
        $checked = $this->props['checked'] ?? false;
        $disabled = $this->props['disabled'] ?? false;
        $name = $this->props['name'] ?? '';
        $id = $this->props['id'] ?? '';
        
        $classes = $this->cn(
            'aspect-square h-4 w-4 rounded-full border border-slate-200 text-slate-900 shadow focus:outline-none focus-visible:ring-1 focus-visible:ring-slate-950 disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-800 dark:text-slate-50 dark:focus-visible:ring-slate-300',
            $this->className
        );
        
        $attributes = $this->getAttributes(['value', 'checked', 'disabled', 'name', 'id']);
        
        return sprintf(
            '<button class="%s" role="radio" id="%s" name="%s" value="%s" data-state="%s" %s %s %s>
                <span class="flex items-center justify-center">
                    <span class="h-2.5 w-2.5 rounded-full bg-current" style="display: %s;"></span>
                </span>
            </button>',
            $classes,
            $this->escape($id),
            $this->escape($name),
            $this->escape($value),
            $checked ? 'checked' : 'unchecked',
            $disabled ? 'disabled' : '',
            $attributes,
            $disabled ? 'aria-disabled="true"' : '',
            $checked ? 'block' : 'none'
        );
    }
}

// Enregistrer les composants
ComponentManager::register('RadioGroup', 'RadioGroup');
ComponentManager::register('RadioGroupItem', 'RadioGroupItem'); 