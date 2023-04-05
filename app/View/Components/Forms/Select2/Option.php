<?php

namespace App\View\Components\Forms\Select2;

use Illuminate\View\Component;

class Option extends Component
{
    public $name;

    public $optionData;

    public $multiple;

    public $selectedKey;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $optionData, $multiple, $selectedKey)
    {
        // $this->name         = $name;
        $this->optionData  = $optionData;
        $this->multiple     = $multiple;
        $this->selectedKey  = $selectedKey;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.backend.forms.select2.option');
    }
}
