<?php

namespace App\View\Components;

use Illuminate\View\Component;

class badge extends Component
{
  public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($val)
    {
    $this->type=$val;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.badge');
    }
}
