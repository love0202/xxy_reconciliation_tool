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
            '1102' => [
                'name' => '创建对账方案',
                'routeName' => 'project.create',
                'class' => 'bi bi-journal-check',
                'isHidden' => 1,
                'parentId' => '1101',
            ],
        ],
    ],
    '12' => [
        'name' => '重量管理',
        'routeName' => 'weight.index',
        'show' => 1,
        'class' => 'bi bi-cash-coin',
        'items' => [
            '1201' => [
                'name' => '重量数据',
                'routeName' => 'weight.index',
                'class' => 'bi bi-calendar-check',
            ],
            '1202' => [
                'name' => '重量文件',
                'routeName' => 'weight.file',
                'class' => 'bi bi-filetype-xlsx',
            ],
            '1203' => [
                'name' => '导入重量',
                'routeName' => 'weight.create',
                'class' => 'bi bi-filetype-xlsx',
                'isHidden' => 1,
                'parentId' => '1201',
            ],
            '1204' => [
                'name' => '编辑重量',
                'routeName' => 'weight.edit',
                'class' => 'bi bi-pencil-square',
                'isHidden' => 1,
                'parentId' => '1201',
            ],
        ],
    ],
    '20' => [
        'name' => '首页',
        'routeName' => 'project.show',
        'show' => 2,
        'class' => 'bi bi-house',
        'items' => [
            '2001' => [
                'name' => '方案统计',
                'routeName' => 'project.show',
                'class' => 'bi bi-pc-display-horizontal',
            ],
        ],
    ],
    '21' => [
        'name' => '商户管理',
        'routeName' => 'merchant.tianmao.file',
        'show' => 2,
        'class' => 'bi bi-cart4',
        'items' => [
            '2101' => [
                'name' => '天猫商户文件',
                'routeName' => 'merchant.tianmao.file',
                'class' => 'bi bi-filetype-xlsx',
            ],
            '2102' => [
                'name' => '导入文件',
                'routeName' => 'merchant.tianmao.create',
                'class' => 'bi bi-filetype-xlsx',
                'isHidden' => 1,
                'parentId' => '2101',
            ],
            '2121' => [
                'name' => '拼多多商户文件',
                'routeName' => 'merchant.pinduoduo.file',
                'class' => 'bi bi-filetype-xlsx',
            ],
            '2122' => [
                'name' => '拼多多商户数据',
                'routeName' => 'merchant.pinduoduo.index',
                'class' => 'bi bi-calendar-check',
                'isHidden' => 1,
                'parentId' => '2121',
            ],
            '2123' => [
                'name' => '导入拼多多手工订单数据',
                'routeName' => 'merchant.pinduoduo.create',
                'class' => 'bi bi-filetype-xlsx',
                'isHidden' => 1,
                'parentId' => '2121',
            ],
            '2131' => [
                'name' => '旺店通商户文件',
                'routeName' => 'merchant.wangdiantong.file',
                'class' => 'bi bi-filetype-xlsx',
            ],
            '2132' => [
                'name' => '旺店通商户数据',
                'routeName' => 'merchant.wangdiantong.index',
                'class' => 'bi bi-calendar-check',
                'isHidden' => 1,
                'parentId' => '2131',
            ],
            '2133' => [
                'name' => '导入旺店通数据',
                'routeName' => 'merchant.wangdiantong.create',
                'class' => 'bi bi-filetype-xlsx',
                'isHidden' => 1,
                'parentId' => '2131',
            ],
        ],
    ],
    '22' => [
        'name' => '快递管理',
        'routeName' => 'express.file',
        'show' => 2,
        'class' => 'bi bi-truck-front',
        'items' => [
            '2201' => [
                'name' => '快递文件',
                'routeName' => 'express.file',
                'class' => 'bi bi-filetype-xlsx',
            ],
            '2202' => [
                'name' => '快递数据',
                'routeName' => 'express.index',
                'class' => 'bi bi-calendar-check',
                'isHidden' => 1,
                'parentId' => '2201',
            ],
            '2203' => [
                'name' => '导入快递',
                'routeName' => 'express.create',
                'class' => 'bi bi-filetype-xlsx',
                'isHidden' => 1,
                'parentId' => '2201',
            ],
        ],
    ],
];
