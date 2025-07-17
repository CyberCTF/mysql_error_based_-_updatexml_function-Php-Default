<?php
require_once __DIR__ . '/../Component.php';

class Calendar extends Component {
    public function render() {
        $classes = $this->cn(
            'p-3 text-slate-950 dark:text-slate-50',
            $this->className
        );
        
        $month = $this->props['month'] ?? date('F Y');
        
        return sprintf(
            '<div class="%s">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold">%s</h3>
                    <div class="flex space-x-1">
                        <button class="h-7 w-7 bg-transparent p-0 opacity-50 hover:opacity-100">‹</button>
                        <button class="h-7 w-7 bg-transparent p-0 opacity-50 hover:opacity-100">›</button>
                    </div>
                </div>
                <div class="grid grid-cols-7 gap-1 text-center text-sm">
                    <div class="font-medium text-slate-500">Mo</div>
                    <div class="font-medium text-slate-500">Tu</div>
                    <div class="font-medium text-slate-500">We</div>
                    <div class="font-medium text-slate-500">Th</div>
                    <div class="font-medium text-slate-500">Fr</div>
                    <div class="font-medium text-slate-500">Sa</div>
                    <div class="font-medium text-slate-500">Su</div>
                </div>
                <div class="grid grid-cols-7 gap-1 mt-2">%s</div>
            </div>',
            $classes,
            $this->escape($month),
            $this->children
        );
    }
}

ComponentManager::register('Calendar', 'Calendar'); 