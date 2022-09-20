<?php
return [
    '10' => [
        'name'   => '首页',
        'url'    => '/',
        'pos'    => 'main', //位置显示 main、header、right三个选择
        'show'   => 1,
        'class'  => 'iconfont icon-home',
        'items'  => [
            '1001' => [
                'name'    => '个人面板',
                'url'     => '/dashboard/index/index',
                'i-class' => 'iconfont icon-add',
            ],
        ],
    ],
    '11' => [
        'name'   => '计划管理',
        'url'    => '/plan/myplan/index',
        'pos'    => 'main',
        'show'   => 1,
        'class'  => 'iconfont icon-folder',
        'items'  => [
            '1101' => [
                'name'       => '创建计划',
                'url'        => '/plan/add/index',
                'i-class'    => 'iconfont',
            ],
            '1102' => [
                'name'       => '我的计划',
                'url'        => '/plan/myplan/index',
                'i-class'    => 'iconfont',
                'privileges' => ['1105']
            ],
            '1106' => [
                'name'       => '审核计划',
                'url'        => '/plan/audit/index',
                'i-class'    => 'iconfont',
                'privileges' => ['1106']
            ],
            '1103' => [
                'name'       => '响应计划',
                'url'        => '/plan/response/index',
                'i-class'    => 'iconfont',
                'privileges' => ['1107']
            ],
        ],
    ],
];
