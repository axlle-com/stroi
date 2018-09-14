<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Search\TagsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tags-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sitemap') ?>

    <?= $form->field($model, 'alias_category') ?>

    <?= $form->field($model, 'alias_tags') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'title_short') ?>

    <?php // echo $form->field($model, 'title_seo') ?>

    <?php // echo $form->field($model, 'description_seo') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'type') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
