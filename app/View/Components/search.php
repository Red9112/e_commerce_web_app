<?php

namespace App\View\Components;

use Illuminate\View\Component;

class search extends Component
{
   public  $route;

    public function __construct($route)
    {
        $this->route=$route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.search');
    }
}
