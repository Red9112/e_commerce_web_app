<?php

namespace App\View\Components;

use Illuminate\View\Component;

class created extends Component
{
    public $date;
    public $name;
    public $userid;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($date,$name=null,$userid=null)
    {
        $this->date=$date->diffForHumans();
        $this->name=$name;
        $this->userid=$userid;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.created');
    }
}
