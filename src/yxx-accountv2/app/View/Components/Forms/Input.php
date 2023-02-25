<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $value;
    public $placeholder;

    public function __construct($name, $value, $placeholder)
    {
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
    }

    public function render()
    {
        return view('components.forms.input');
    }
}
