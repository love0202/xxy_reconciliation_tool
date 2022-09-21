<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Input extends Component
{
    public $type;
    public $message;

    /**
     * 创建组件实例
     *
     * @param string $type
     * @param string $message
     * @return void
     */
    public function __construct($type, $message = '')
    {
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * 将一个视图或者字符串传递给组件用于渲染
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input');
    }
}
