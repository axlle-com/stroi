<?php


    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');

    require(__DIR__ . '/../../vendor/autoload.php');
    require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
    require(__DIR__ . '/../../common/config/bootstrap.php');
    require(__DIR__ . '/../config/bootstrap.php');

    $config = yii\helpers\ArrayHelper::merge(
        require(__DIR__ . '/../../common/config/main.php'),
        require(__DIR__ . '/../../common/config/main-local.php'),
        require(__DIR__ . '/../config/main.php'),
        require(__DIR__ . '/../config/main-local.php')
    );

    $service = new \yii\di\ServiceLocator();
    $service->set("cache",'common\cache\Base64Cache');

    $application = new yii\web\Application($config);
    $application->set('locator',$service);
    $application->run();
