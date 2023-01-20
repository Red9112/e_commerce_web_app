<?php

namespace App\View\Components;

use Illuminate\View\Component;

class createSelect extends Component
{

public $idLabel;
public $selectType;
public $objects;
    public function __construct($idLabel,$selectType,$objects)
    {
        $this->idLabel=$idLabel;
        $this->selectType=$selectType;
        $this->objects=$objects;
    }


    public function render()
    {
        return view('components.create-select');
    }
}
