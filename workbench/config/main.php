<?php
return [
    'name'=>"HassCMS",
    'sourceLanguage'=>'en-US',
    'language'=>'zh-CN',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => [
        'common\hasscms\Bootstrap',
        'hasscms\user\Bootstrap',
        'hasscms\node\Bootstrap',
        'hasscms\file\Bootstrap',
    		'hasscms\field\Bootstrap'
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\DbCache'
        ],
        'session' => [
            'class' => 'yii\web\DbSession'
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'messageConfig' => [
                'from' => [
                    'noreply@manyibu.com' => '慢一步'
                ],
                'charset' => 'UTF-8'
            ],
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.exmail.qq.com',
                'username' => 'noreply@manyibu.com',
                'password' => 'manyibu9527',
                'port' => '465',
                'encryption' => 'ssl'
            ],
            'viewPath' => "@common/mail"
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@app/themes/basic'
                ],
                'baseUrl' => '@web/themes/basic'
            ]
        ],
        'authManager' => [
            'class' => 'mdm\admin\components\DbManager'
        ],
        'user' => [
            'class' => 'hasscms\user\components\User'
        ],
        'setting' => [
            'class' => 'hasscms\setting\components\Setting'
        ],
        'menu' => [
            'class' => 'hasscms\menu\components\Menu'
        ],
        'taxonomy' => [
            'class' => 'hasscms\taxonomy\components\Taxonomy'
        ],
        'file' => [
            'class' => 'hasscms\file\components\File',
            "components"=>[
              "local"=>[
                  "baseUrl"=>"http://127.0.0.1/hasscms/upload"
              ]
            ],
        ],
        'i18n' => [
            'class' => 'Zelenin\yii\modules\I18n\components\I18N',
            'languages' => ['zh-CN', 'en-US']
        ]
    ],
    'modules' => [
        'translations' => [
            'class' => 'Zelenin\yii\modules\I18n\Module'
        ],
        'user' => [
            'class' => 'hasscms\user\Module'
        ],
        'rbac' => [
            'class' => 'hasscms\rbac\Module'
        ],
        'setting' => [
            'class' => 'hasscms\setting\Module'
        ],
        'taxonomy' => [
            'class' => 'hasscms\taxonomy\Module'
        ],
        'menu' => [
            'class' => 'hasscms\menu\Module'
        ],
        'comment' => [
            'class' => 'hasscms\comment\Module'
        ],
        'tag' => [
            'class' => 'hasscms\tag\Module'
        ],
    		'field' => [
    				'class' => 'hasscms\field\Module'
    		],
        'file' => [
            'class' => 'hasscms\file\Module'
        ],

        'node' => [
            'class' => 'hasscms\node\Module'
        ],
        'system' => [
            'class' => 'hasscms\system\Module',
        ],
    		'gridview' =>  [
    				'class' => '\kartik\grid\Module'
    		]
    ]
];
