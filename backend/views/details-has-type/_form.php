<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\DetailsHasType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="details-has-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'details_id')->textInput() ?>
    <?
    $category = common\models\Details::find()->all();
    $items = ArrayHelper::map($category,'id','name');
    $params = [
        'prompt' => 'Укажите детали'
    ];
    echo $form->field($model, 'details_id')->dropDownList($items,$params);
    ?>

    <?//= $form->field($model, 'type_id')->textInput() ?>
    <?
    $category = common\models\Type::find()->all();
    $items = ArrayHelper::map($category,'id','title');
    $params = [
        'prompt' => 'Укажите тип'
    ];
    echo $form->field($model, 'type_id')->dropDownList($items,$params);
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
