<?php
declare (strict_types = 1);

namespace app\merchant\controller;
use app\common\BaseController;
use app\common\YxxConfig;

class IndexController extends BaseController
{
    public function index()
    {
        $params = [];
        $test = YxxConfig::name('MERCHANT_TYPE','T1');
        $test1 = YxxConfig::list('MERCHANT_TYPE');

        return view('index/index', $params);
    }
}
