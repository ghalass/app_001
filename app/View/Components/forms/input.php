<?php

namespace App\View\Components\forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class input extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $label;
    public $message;
    public $defaultValue;
    public function __construct($name, $label, $message, $defaultValue = '')
    {
        $this->name = $name;
        $this->label = $label;
        $this->message = $message;
        $this->defaultValue = $defaultValue;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.input');
    }
}