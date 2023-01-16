<?php

namespace App\View\Components;

use Illuminate\View\Component;

class card extends Component
{
    public $header;
    public $collection;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($header,$collection=null)
    {
       $this->header=$header;
       $this->collection=$collection;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card');
    }
}
