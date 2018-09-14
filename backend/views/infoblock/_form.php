<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Infoblock */
/* @var $form yii\widgets\ActiveForm */

if($model->date_pub){
    $date_pub = $model->date_pub;
}else{
    $date_pub = date('Y-m-d');
}
if($model->date_end){
    $date_end = $model->date_end;
}else{
    $date_end = date('Y-m-d');
}
?>

<div class="infoblock-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'published')->textInput() ?>
    <?= $form->field($model, 'published')->dropDownList([
        '1' => 'Опубликовано',
        '0' => 'Не опубликовано',
    ]);
    ?>

    <?//= $form->field($model, 'favourites')->textInput() ?>
    <?= $form->field($model, 'favourites')->dropDownList([
        '0' => 'Нет',
        '1' => 'Да',
    ]);
    ?>

    <?= $form->field($model, 'show_img')->dropDownList([
        '0' => 'Не показывать',
        '1' => 'Показывать',
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

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date_pub')->textInput(['value' => $date_pub, 'maxlength' => true]) ?>

    <?= $form->field($model, 'date_end')->textInput(['value' => $date_end, 'maxlength' => true]) ?>

    <?//= $form->field($model, 'general_photo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
