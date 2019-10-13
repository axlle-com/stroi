<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '/admin',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity',
                'httpOnly' => true,
                'domain' => $params['cookieDomain'],
            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => '_session',
            'cookieParams' => [
                'domain' => $params['cookieDomain'],
                'httpOnly' => true,
                ],

        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '',
            'rules' => [
                ''=> 'site/index',
                '<action>'=>'site/<action>',
            ],
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '.htm',
            'rules' => [
                ['class' => 'frontend\filters\UrlRuleFrontend'],
                '<action:cashes>'=>'site/<action>',
                '<action:search|captcha>'=>'site/<action>',

                //'<action>'=>'site/<action>',
                //'<alias_item:[\w_-]+>'=>'site/item',
                '<alias_category:[\w_-]+>/Page-<page:\d+>' => 'site/category',
                '<alias_category:[\w_-]+>/Page-<page:\d+>/sort-<sort:[\w_-]+>' => 'site/category',
                '<alias_category:[\w_-]+>/sort-<sort:[\w_-]+>' => 'site/category',
                '<alias_category:[\w_-]+>'=>'site/category',

                //'<alias_category:[\w_-]+>/<alias_tags:[\w_-]+>/Page-<page:\d+>' => 'site/tags',
                //'price/<alias_item:[\w_-]+>'=>'site/item',
                '<alias_category:[\w_-]+>/<alias_item:[\w_-]+>'=>'site/item',
                '' => 'site/index',
            ],
        ],
        /*'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                ],
            ],
        ],*/

    ],
    'as access' => [
        'class' => 'yii\filters\AccessControl',
        'except' => ['site/login', 'site/error','site/captcha'],
        'rules' => [
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
    ],
    'params' => $params,
];
