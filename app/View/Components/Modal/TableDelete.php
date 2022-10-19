<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;

class TableDelete extends Component
{
    public $id;
    public $name;
    public $message;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id,$name,$message)
    {
        $this->id = $id;
        $this->name = $name;
        $this->message = $message;
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
            'name' => $this->name,
            'message' => $this->message,
        ];
        return view('components.modal.table-delete', $data);
    }
}
