<?php

namespace App\View\Components\Backend;

use Illuminate\View\Component;

class SideBar extends Component
{

    public $name; // new property
    public $link;// new property
    public $icon;// new property
    public $type;// new property
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $link, $icon)
    {

        $this->name = $name;
        $this->link = $link;
        $this->icon = $icon;
        // $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.backend.side-bar');
    }
}
