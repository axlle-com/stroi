<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Folder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="folder-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'show_img')->dropDownList([
        '1' => 'Показывать',
        '0' => 'Не показывать',
    ]);
    ?>

    <?= $form->field($model, 'watermark')->dropDownList([
        '1' => 'Да',
        '0' => 'Нет',
    ]);
    ?>

    <?= $form->field($model, 'small_img')->dropDownList([
        '1' => 'Да',
        '0' => 'Нет',
    ]);
    ?>

    <?= $form->field($model, 'tumb_img')->dropDownList([
        '0' => 'Нет',
        '1' => 'Да',
    ]);
    ?>

    <?//= $form->field($model, 'general_photo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
