<?php
if ($_SERVER['SERVER_ADDR'] == '127.0.0.1')
{
    return  [
        'class' => 'yii\caching\FileCache',//'yii\redis\Cache',
        /*'redis' => [
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ]*/
    ];
}else{
    return  [
        'useMemcached' => true,
        'class' => 'yii\caching\MemCache',
        'servers' => [
            [
                'host' => '127.0.0.1',
                'port' => 11211,
            ],
        ],
    ];
}
