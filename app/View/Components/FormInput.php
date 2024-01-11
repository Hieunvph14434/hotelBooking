<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $name,
        public $label = "",
        public bool $required = false,
        public $oldValue = null,
        public bool $datepicker = false,
        public $type = 'text',
        public $ng = null,
        public bool $previewImg = false,
        public $autocomplete = "on",
        public $placeholder = "",
        public $class = "",
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-input');
    }
}
