<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Search\InfoblockSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="infoblock-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'published') ?>

    <?= $form->field($model, 'favourites') ?>

    <?php // echo $form->field($model, 'show_img') ?>

    <?php // echo $form->field($model, 'watermark') ?>

    <?php // echo $form->field($model, 'small_img') ?>

    <?php // echo $form->field($model, 'tumb_img') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'date_pub') ?>

    <?php // echo $form->field($model, 'date_end') ?>

    <?php // echo $form->field($model, 'general_photo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
