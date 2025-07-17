<?php
require_once __DIR__ . '/../Component.php';

class Table extends Component {
    public function render() {
        $classes = $this->cn(
            'w-full caption-bottom text-sm',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<div class="relative w-full overflow-auto"><table class="%s" %s>%s</table></div>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class TableHeader extends Component {
    public function render() {
        $classes = $this->cn(
            '[&_tr]:border-b',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<thead class="%s" %s>%s</thead>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class TableBody extends Component {
    public function render() {
        $classes = $this->cn(
            '[&_tr:last-child]:border-0',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<tbody class="%s" %s>%s</tbody>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class TableFooter extends Component {
    public function render() {
        $classes = $this->cn(
            'bg-slate-900 font-medium text-slate-50 dark:bg-slate-50 dark:text-slate-900',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<tfoot class="%s" %s>%s</tfoot>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class TableRow extends Component {
    public function render() {
        $classes = $this->cn(
            'border-b border-slate-200 transition-colors hover:bg-slate-100/50 data-[state=selected]:bg-slate-100 dark:border-slate-800 dark:hover:bg-slate-800/50 dark:data-[state=selected]:bg-slate-800',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<tr class="%s" %s>%s</tr>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class TableHead extends Component {
    public function render() {
        $classes = $this->cn(
            'h-10 px-2 text-left align-middle font-medium text-slate-500 [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px] dark:text-slate-400',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<th class="%s" %s>%s</th>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class TableCell extends Component {
    public function render() {
        $classes = $this->cn(
            'p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<td class="%s" %s>%s</td>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

class TableCaption extends Component {
    public function render() {
        $classes = $this->cn(
            'mt-4 text-sm text-slate-500 dark:text-slate-400',
            $this->className
        );
        
        $attributes = $this->getAttributes();
        
        return sprintf(
            '<caption class="%s" %s>%s</caption>',
            $classes,
            $attributes,
            $this->children
        );
    }
}

// Enregistrer les composants
ComponentManager::register('Table', 'Table');
ComponentManager::register('TableHeader', 'TableHeader');
ComponentManager::register('TableBody', 'TableBody');
ComponentManager::register('TableFooter', 'TableFooter');
ComponentManager::register('TableRow', 'TableRow');
ComponentManager::register('TableHead', 'TableHead');
ComponentManager::register('TableCell', 'TableCell');
ComponentManager::register('TableCaption', 'TableCaption'); 