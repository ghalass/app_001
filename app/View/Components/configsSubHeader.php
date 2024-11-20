<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class configsSubHeader extends Component
{
    /**
     * Create a new component instance.
     */
    public string $page;
    public string $search;
    public function __construct($page = 'configs', $search = '')
    {
        $this->page = $page;
        $this->search = $search;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.configs-sub-header');
    }
}