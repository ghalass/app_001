<?php

namespace App\View\Components\forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class select extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $label;
    public $items;
    public $message;
    public $defaultValue;
    public function __construct($name, $label, $items, $message, $defaultValue = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->items = $items;
        $this->message = $message;
        $this->defaultValue = $defaultValue;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.select');
    }
}