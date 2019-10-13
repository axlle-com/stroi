<?php
return [
    'name' => 'ООО "Сруб-Строй"',
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
