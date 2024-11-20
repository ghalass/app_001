<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class configStatistique extends Component
{
    /**
     * Create a new component instance.
     */
    public string $total;
    public string $title;
    public string $icon;
    public string $link;
    public function __construct($total = 0, $title = '', $icon = '', $link = '')
    {
        $this->total = $total;
        $this->title = $title;
        $this->icon = $icon;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.config-statistique');
    }
}