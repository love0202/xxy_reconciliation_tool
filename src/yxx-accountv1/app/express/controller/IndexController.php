<?php
declare (strict_types = 1);

namespace app\express\controller;

class IndexController
{
    public function index()
    {
        $params = [];

        return view('index/index', $params);
    }
}
