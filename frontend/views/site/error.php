<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<div class="error-page text-center">
    <div class="container">
        <h2 class="error-title"><?//=$exception->statusCode?></h2>
        <h3 class="error-subtitle"><?= Html::encode($this->title)?></h3>

        <p class="error-text center-block alert alert-danger"><?= nl2br(Html::encode($message)) ?></p>

        <form action="#">
            <div class="form-group">
                <input class="form-control input-lg input-border-bottom text-center" type="text" placeholder="Поиск...">
            </div><!-- end .form-group -->
            <div class="form-group">
                <input type="submit" class="btn btn-custom2 btn-border no-radius min-width" value="Искать">
            </div><!-- end .form-group -->
        </form>
    </div><!-- End .container -->
</div><!-- End .error-page -->
