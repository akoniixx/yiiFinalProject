<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'th-TH',
    'timezone' => 'Asia/Bangkok',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
            ],
        ],
        'studio' => [
            'class' => 'common\components\Studio',
        ],
        // 'urlManager' => [
        //     'enablePrettyUrl' => true,
        //     'showScriptName' => true,
        //     'rules' => [
        //         '<controller:(announce)>/<action:(view)>' => 'item/oview',
        //         '<controller:(announce)>/<id:\d+>' => 'item/oview',
        //         '<controller:\w+>/<id:\d+>' => '<controller>/view',
        //     ],
        //     // 'class' => 'codemix\localeurls\UrlManager',
        //     // 'languages' => ['en' => 'en-EN', 'th' => 'th-TH'],
        //     // ...
        // ],
    ],
];
