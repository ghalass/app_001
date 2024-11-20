<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class configsHeader extends Component
{
    /**
     * Create a new component instance.
     */
    public string $page;
    public function __construct($page = 'configs')
    {
        $this->page = $page;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.configs-header');
    }
}