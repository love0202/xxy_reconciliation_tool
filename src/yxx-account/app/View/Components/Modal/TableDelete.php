<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;

class TableDelete extends Component
{
    public $id;
    public $url;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $url)
    {
        $this->id = $id;
        $this->url = $url;
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
        ];
        return view('components.modal.table-delete', $data);
    }
}
