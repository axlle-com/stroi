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
            'identityCookie' => ['name' => '_identity-site', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-site',
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
                /*[
                    'pattern' => '<alias_category:[\w_-]+>/<alias_tags:[\w_-]+>/Page-<page:\d+>',
                    'route' => 'site/tags',
                    'suffix' => '.htm',
                ],
                [
                    'pattern' => '<alias_category:[\w_-]+>/<alias_tags:[\w_-]+>',
                    'route' => 'site/tags',
                    'suffix' => '.htm',
                ],*/
                [
                    'class'=>'frontend\filters\UrlUncategorizedRule'
                ],
                [
                    'class'=>'frontend\filters\UrlTagRule'
                ],
                '<action:cashes>'=>'site/<action>',
                '<action:search|captcha>'=>'site/<action>',

                //'<action:about>'=>'site/<action>',
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
