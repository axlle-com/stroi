<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Search\DetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'item_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'same_item') ?>

    <?= $form->field($model, 'material') ?>

    <?php // echo $form->field($model, 'initial_size') ?>

    <?php // echo $form->field($model, 'square') ?>

    <?php // echo $form->field($model, 'room') ?>

    <?php // echo $form->field($model, 'floor') ?>

    <?php // echo $form->field($model, 'mansard') ?>

    <?php // echo $form->field($model, 'balcony') ?>

    <?php // echo $form->field($model, 'krilco') ?>

    <?php // echo $form->field($model, 'garage') ?>

    <?php // echo $form->field($model, 'erker') ?>

    <?php // echo $form->field($model, 'dacha') ?>

    <?php // echo $form->field($model, 'original_price') ?>

    <?php // echo $form->field($model, 'time_build') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
