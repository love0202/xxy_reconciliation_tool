<?php

use app\ExceptionHandle;
use app\Request;
use app\common\Bootstrap;

// 容器Provider定义文件
return [
    'think\Request' => Request::class,
    'think\exception\Handle' => ExceptionHandle::class,
    'think\Paginator' => Bootstrap::class,
];
