<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;

class Base extends Component
{
    public $id;
    public $url;
    public $name;
    public $message;
    public $biClass;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $url, $name, $message, $biClass)
    {
        $this->id = $id;
        $this->name = $name;
        $this->message = $message;
        $this->url = $url;
        $this->biClass = $biClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data = [
            'id' => $this->id,
            'url' => $this->url,
            'name' => $this->name,
            'message' => $this->message,
            'biClass' => $this->biClass,
        ];
        return view('components.modal.base', $data);
    }
}
