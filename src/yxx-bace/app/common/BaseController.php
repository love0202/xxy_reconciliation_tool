<?php
declare (strict_types=1);

namespace app\common;

use think\facade\View;
use think\facade\Request;

class BaseController
{
    public $appName;
    public $controllerName;
    public $actionName;

    public function __construct()
    {
        $this->setParams();
        $this->auth();
        $this->setViewMenu();
    }

    public function auth()
    {
        if (false) {
            dd('无权限访问');
        }
    }

    public function setViewMenu()
    {
        $menu = [
            'index' => [],
            'merchant' => [
                1 => [
                    'name' => '商户数据源文件',
                    'url' => '/merchant/file/list',
                ],
            ],
            'express' => [],
        ];
        $nav = $menu[$this->appName];
        View::assign('nav', $nav);
    }

    public function setParams()
    {
        // 多应用下的应用名称
        $this->appName = app('http')->getName();
        // 控制器的名称
        $this->controllerName = Request::controller(true);
        // 方法的名称
        $this->actionName = Request::action(true);
    }
}
