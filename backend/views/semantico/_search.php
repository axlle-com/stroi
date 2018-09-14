<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Search\SemanticoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="semantico-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'item_id') ?>

    <?= $form->field($model, 'key_name') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'title_seo') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'description_seo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
