<?php
namespace app\home\controller;

class IndexController
{
    public function index()
    {
        $params = [];

        return view('index/index', $params);
    }

}