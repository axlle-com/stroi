<?php
return [
    'name' => 'ООО "Сруб-Строй"',
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@common/runtime/cache',
        ],
        
        'db'  => require(__DIR__ . '/db.php'),
        'common' => [
            'class' => 'common\components\Common',
        ],

    ],
];
