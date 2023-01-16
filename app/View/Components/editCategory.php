<?php

namespace App\View\Components;

use Illuminate\View\Component;

class editCategory extends Component
{
    public $productcats;
    public $categories;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($categories,$productcats)
    {
   $this->productcats=$productcats;
   $this->categories=$categories;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.edit-category');
    }
}
