<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'assetManager' => [
            'basePath' => '@webroot/assets',
            'baseUrl' => '@web/assets'
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
            'suffix' => '.htm',
            'rules' => [
                [
                    'pattern' => 'sitemap',
                    'route' => 'sitemap/index',
                    'suffix' => '.xml',
                ],
                [
                    'class'=>'frontend\filters\UrlUncategorizedRule'
                ],
                [
                    'class'=>'frontend\filters\UrlTagRule'
                ],
                '<_a:search|captcha>'=>'site/<_a>',

                //'<_a:about>'=>'site/<_a>',
                '<alias_category:[\w_-]+>/Page-<page:\d+>' => 'site/category',
                '<alias_category:[\w_-]+>'=>'site/category',
                '<alias_category:[\w_-]+>/<alias_item:[\w_-]+>'=>'site/item',
                '' => 'site/index',
            ]
        ],
        'common' => [
            'class' => 'frontend\components\Common',
        ],
    ],
    'params' => $params,
];
