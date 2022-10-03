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
                'class' => 'bi bi-house',
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
                'name' => '方案',
                'routeName' => 'project.index',
                'class' => 'bi bi-journal-check',
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
                'name'    => '方案统计',
                'routeName' => 'project.show',
                'class' => 'bi bi-pc-display-horizontal',
            ],
        ],
    ],
    '21' => [
        'name'   => '商户管理',
        'routeName' => 'merchant.tianmao',
        'show'   => 2,
        'class'  => 'bi bi-cart4',
        'items'  => [
            '2110' => [
                'name'    => '添加文件',
                'routeName' => 'merchant.create',
                'class' => 'bi bi-filetype-xlsx',
            ],
            '2101' => [
                'name'    => '天猫商户文件',
                'routeName' => 'merchant.tianmao',
                'class' => 'bi bi-filetype-xlsx',
            ],
            '2102' => [
                'name'    => '淘宝商户文件',
                'routeName' => 'merchant.taobao',
                'class' => 'bi bi-filetype-xlsx',
            ],
            '2103' => [
                'name'    => '拼多多商户文件',
                'routeName' => 'merchant.pinduoduo',
                'class' => 'bi bi-filetype-xlsx',
            ],
            '2105' => [
                'name'    => '商户数据',
                'routeName' => 'merchant.index',
                'class' => 'bi bi-calendar-check',
            ],
        ],
    ],
    '22' => [
        'name'   => '快递管理',
        'routeName' => 'express.file',
        'show'   => 2,
        'class'  => 'bi bi-truck-front',
        'items'  => [
            '2210' => [
                'name'    => '添加文件',
                'routeName' => 'express.create',
                'class' => 'bi bi-filetype-xlsx',
            ],
            '2201' => [
                'name'    => '快递文件',
                'routeName' => 'express.file',
                'class' => 'bi bi-filetype-xlsx',
            ],
            '2202' => [
                'name'    => '快递数据',
                'routeName' => 'express.index',
                'class' => 'bi bi-calendar-check',
            ],
        ],
    ],
    '23' => [
        'name'   => '重量管理',
        'routeName' => 'weight.index',
        'show'   => 2,
        'class'  => 'bi bi-cash-coin',
        'items'  => [
            '2310' => [
                'name'    => '添加文件',
                'routeName' => 'weight.create',
                'class' => 'bi bi-filetype-xlsx',
            ],
            '2301' => [
                'name'    => '重量文件',
                'routeName' => 'weight.file',
                'class' => 'bi bi-filetype-xlsx',
            ],
            '2302' => [
                'name'    => '重量数据汇总',
                'routeName' => 'weight.index',
                'class' => 'bi bi-calendar-check',
            ],
        ],
    ],
];
