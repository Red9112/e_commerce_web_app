<?php

namespace App\View\Components;

use Illuminate\View\Component;

class editSelect extends Component
{

    public $savedobjects;
    public $objects;
    public $idLabel;
    public $selectType;

    public function __construct($savedobjects,$objects,$selectType,$idLabel)
    {

        $this->savedobjects=$savedobjects;
        $this->objects=$objects;
        $this->idLabel=$idLabel;
        $this->selectType=$selectType;


    }


    public function render()
    {
        return view('components.edit-select');
    }
}
