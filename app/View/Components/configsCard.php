<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class configsCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $item;
    public $page;
    public function __construct($item, $page)
    {
        $this->item = $item;
        $this->page = $page;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.configs-card');
    }
}