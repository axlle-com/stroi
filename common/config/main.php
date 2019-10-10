<?php
return [
    'name' => 'ООО "Сруб-Строй"',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
            //'cachePath' => '@frontend/runtime/cache'
        ],
        
        'db'  => require(__DIR__ . '/db.php'),
        
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '.htm',
            'rules' => [
                '' => 'site/index',


            ]
        ],
        
        'common' => [
            'class' => 'common\components\Common',
        ],

    ],
];
