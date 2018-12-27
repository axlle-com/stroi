<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\assets\AppAssetHome;
use common\widgets\Alert;

AppAssetHome::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 9]> <html class="ie9" lang="<?= Yii::$app->language ?>"> <![endif]-->
<!--[if !IE]><!--> <html lang="<?= Yii::$app->language ?>"> <!--<![endif]-->

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="wCjd8Y4kqNjUZFnlWrsqH4ZUFPdkLyOkKglNbDRy2js" />
    <meta name="yandex-verification" content="bc2f777ca9c7edf9" />
    <link rel="icon" type="image/png" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>


    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div id="wrapper">
    <? echo $this->render("//inc/headHome") ?>
    <?= $content ?>
    <? echo $this->render("//inc/footer") ?>
</div>
<a href="#top" id="scroll-top" title="Back to Top"><i class="fa fa-angle-up"></i></a>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
