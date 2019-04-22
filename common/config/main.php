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
                'username'   => 'web@srub-stroi.ru',
                'password'   => '',
                'ishtml' => true,
                'charset' => 'UTF-8',
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.beget.com',
                'username' => 'web@srub-stroi.ru',
                'password' => '',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
    ],
];
