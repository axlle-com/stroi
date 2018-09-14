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
                //'<action:login|contact|signup>'=>'site/<action>',
                //'<action>'=>'site/<action>',
                //'<alias:[\w_-]+>'=>'site/category',
                //'<alias:[\w_-]+>/<alias:[\w_-]+>'=>'site/item',
                '' => 'site/index',


            ]
        ],
        
        'common' => [
            'class' => 'common\components\Common',
        ],
        
        'mail' => [
            'class'            => 'zyx\phpmailer\Mailer',
            'viewPath'         => '@common/mail',
            'useFileTransport' => false,
            'config'           => [
                'mailer'     => 'smtp',
                'host'       => 'smtp.beget.com',
                'port'       => '465',
                'smtpsecure' => 'ssl',
                'smtpauth'   => true,
                'username'   => 'www@srub-stroi.ru',
                'password'   => '19*8i9h5',
                'ishtml' => true,
                'charset' => 'UTF-8',
            ],
        ],
    ],
];
