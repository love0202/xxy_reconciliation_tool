<?php
namespace app\admin\controller;

class IndexController
{
    public function index()
    {
        $params = [];

        return view('index/index', $params);
    }
}