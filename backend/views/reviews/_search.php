<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Search\ReviewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reviews-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'data') ?>

    <?= $form->field($model, 'place') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'positively') ?>

    <?php // echo $form->field($model, 'media') ?>

    <?php // echo $form->field($model, 'show_img') ?>

    <?php // echo $form->field($model, 'watermark') ?>

    <?php // echo $form->field($model, 'small_img') ?>

    <?php // echo $form->field($model, 'tumb_img') ?>

    <?php // echo $form->field($model, 'general_photo') ?>

    <?php // echo $form->field($model, 'data_rev') ?>

    <?php // echo $form->field($model, 'name_rev') ?>

    <?php // echo $form->field($model, 'title_rev') ?>

    <?php // echo $form->field($model, 'description_rev') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
