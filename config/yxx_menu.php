<?php
return [
    '10' => [
        'name' => '首页',
        'routeName' => 'dashboard.index',
        'show' => 1,
        'class' => 'bi bi-house',
        'items' => [
            '1001' => [
                'name' => '个人面板',
                'routeName' => 'dashboard.index',
                'i-class' => 'bi bi-house',
            ],
        ],
    ],
    '11' => [
        'name' => '对账方案管理',
        'routeName' => 'project.index',
        'show' => 1,
        'class' => 'bi bi-journal-check',
        'items' => [
            '1101' => [
                'name' => '对账方案管理',
                'routeName' => 'project.index',
                'i-class' => 'bi bi-journal-check',
            ],
        ],
    ],
    '20' => [
        'name'   => '首页',
        'routeName' => 'project.show',
        'show'   => 2,
        'class'  => 'bi bi-house',
        'items'  => [
            '2001' => [
                'name'    => '对账方案查看',
                'routeName' => 'project.show',
                'i-class' => 'bi bi-house',
            ],
        ],
    ],
    '21' => [
        'name'   => '商户数据管理',
        'routeName' => 'merchant.index',
        'show'   => 2,
        'class'  => 'bi bi-cart4',
        'items'  => [
            '2101' => [
                'name'    => '文件管理',
                'routeName' => 'merchant.index',
                'i-class' => 'bi bi-cart4',
            ],
        ],
    ],
    '22' => [
        'name'   => '快递数据管理',
        'routeName' => 'express.index',
        'show'   => 2,
        'class'  => 'bi bi-truck-front',
        'items'  => [
            '2201' => [
                'name'    => '文件管理',
                'routeName' => 'express.index',
                'i-class' => 'bi bi-truck-front',
            ],
        ],
    ],
    '23' => [
        'name'   => '重量数据管理',
        'routeName' => 'weight.index',
        'show'   => 2,
        'class'  => 'bi bi-cash-coin',
        'items'  => [
            '2301' => [
                'name'    => '文件管理',
                'routeName' => 'weight.index',
                'i-class' => 'bi bi-cash-coin',
            ],
        ],
    ],
];
