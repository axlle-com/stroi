<?php
return [
    'name' => 'ООО "Сруб-Строй"',
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap'    => ['assetsAutoCompress'],
    'components' => [
        'cache' => require(__DIR__ . '/cache.php'),
        'db'  => require(__DIR__ . '/db.php'),
        'common' => [
            'class' => 'common\components\Common',
        ],
        'assetsAutoCompress' => [
            'class'   => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
            'enabled' => true,
            'readFileTimeout' => 3,           //Time in seconds for reading each asset file
            'jsCompress'                => true,        //Enable minification js in html code
            'jsCompressFlaggedComments' => false,        //Cut comments during processing js
            'cssCompress' => true,        //Enable minification css in html code
            'cssFileCompile'        => true,        //Turning association css files
            'cssFileRemouteCompile' => true,       //Trying to get css files to which the specified path as the remote
            // file, skchat him to her.
            'cssFileCompress'       => true,        //Enable compression and processing before being stored in the css file
            'cssFileBottom'         => false,       //Moving down the page css files
            'cssFileBottomLoadOnJs' => false,       //Transfer css file down the page and uploading them using js
            'jsFileCompile'                 => true,        //Turning association js files
            'jsFileRemouteCompile'          => false,       //Trying to get a js files to which the specified path as the remote file, skchat him to her.
            'jsFileCompress'                => true,        //Enable compression and processing js before saving a file
            'jsFileCompressFlaggedComments' => true,        //Cut comments during processing js
            'noIncludeJsFilesOnPjax' => true,        //Do not connect the js files when all pjax requests
            'htmlFormatter' => [
                //Enable compression html
                'class'         => 'skeeks\yii2\assetsAuto\formatters\html\TylerHtmlCompressor',
                'extra'         => true,       //use more compact algorithm
                'noComments'    => true,        //cut all the html comments
                'maxNumberRows' => 50000,       //The maximum number of rows that the formatter runs on
                //'class' => 'skeeks\yii2\assetsAuto\formatters\html\MrclayHtmlCompressor',
                //or any other your handler implements skeeks\yii2\assetsAuto\IFormatter interface
                //or false
            ],
        ],
    ],
];
