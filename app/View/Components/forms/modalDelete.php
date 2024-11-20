<?php

namespace App\View\Components\forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modalDelete extends Component
{
    /**
     * Create a new component instance.
     */
    public $item;
    public $model;
    public function __construct($item, $model)
    {
        $this->item = $item;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.modal-delete');
    }
}