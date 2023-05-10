<?php

namespace App\View\Components\Backend\Input;

use Illuminate\View\Component;

class InputType extends Component
{

    public $type;
    public $class;
    public $id;
    public $placeholder;
    public $value ;
    public $autocomplete;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $type  = 'text', $class  = 'form-control',  $id=null, $placeholder='...', $value, $autocomplete  ='off')
    {
        $this->type = $type;
        $this->class = $class;
        $this->id = $id;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->autocomplete = $autocomplete;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.backend.forms.input.input-type');
    }
}
