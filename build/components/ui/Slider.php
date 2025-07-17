<?php
require_once __DIR__ . '/../Component.php';

class Slider extends Component {
    public function render() {
        $min = $this->props['min'] ?? 0;
        $max = $this->props['max'] ?? 100;
        $value = $this->props['value'] ?? 50;
        $step = $this->props['step'] ?? 1;
        $disabled = $this->props['disabled'] ?? false;
        
        $classes = $this->cn(
            'relative flex w-full touch-none select-none items-center',
            $this->className
        );
        
        $attributes = $this->getAttributes(['min', 'max', 'value', 'step', 'disabled']);
        
        return sprintf(
            '<div class="%s" %s>
                <div class="relative h-1.5 w-full grow overflow-hidden rounded-full bg-slate-900/20 dark:bg-slate-50/20">
                    <div class="absolute h-full bg-slate-900 dark:bg-slate-50" style="width: %s%%"></div>
                </div>
                <div class="block h-4 w-4 rounded-full border border-slate-200 border-slate-900/50 bg-white shadow transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-slate-950 disabled:pointer-events-none disabled:opacity-50 dark:border-slate-800 dark:border-slate-50/50 dark:bg-slate-950 dark:focus-visible:ring-slate-300" style="left: %s%%; margin-left: -8px; position: absolute;"></div>
            </div>',
            $classes,
            $attributes,
            (($value - $min) / ($max - $min)) * 100,
            (($value - $min) / ($max - $min)) * 100
        );
    }
}

ComponentManager::register('Slider', 'Slider'); 