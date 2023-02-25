<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;

class Loading extends Component
{
    public $id;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $title)
    {
        $this->id = isset($id) && !empty($id) ? $id : 'id';
        $this->title = isset($title) && !empty($title) ? $title : 'title';
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
            'title' => $this->title,
        ];
        return view('components.modal.loading', $data);
    }
}
