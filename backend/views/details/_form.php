<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Details */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="details-form">

    <?php $form = ActiveForm::begin(); ?>
    <?
    $item = common\models\Item::find()->all();
    $items = ArrayHelper::map($item,'id','title');
    $params = [
        'prompt' => 'Укажите статью'
    ];
    echo $form->field($model, 'item_id')->dropDownList($items,$params);
    ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'same_item')->textInput(['maxlength' => true]) ?>

    <?
    $item = common\models\Item::find()->all();
    $items = ArrayHelper::map($item,'id','title');
    $params = [
        'prompt' => 'Укажите похожую статью'
    ];
    echo $form->field($model, 'same_item')->dropDownList($items,$params);
    ?>

    <?//= $form->field($model, 'material')->textInput(['maxlength' => true]) ?>
    <?
    $items = \common\models\Details::getTypeList();
    //$items = ArrayHelper::map($item,'id','name');
    $params = [
        'prompt' => 'Выберите материал'
    ];
    echo $form->field($model, 'material')->dropDownList($items,$params);
    ?>



    <?= $form->field($model, 'initial_size')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'square')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'room')->textInput() ?>

    <?= $form->field($model, 'floor')->textInput() ?>

    <?= $form->field($model, 'mansard')->dropDownList([
        '0' => 'Нет',
        '1' => 'Да',
    ]);
    ?>

    <?= $form->field($model, 'balcony')->dropDownList([
        '0' => 'Нет',
        '1' => 'Да',
    ]);
    ?>

    <?= $form->field($model, 'krilco')->dropDownList([
        '0' => 'Нет',
        '1' => 'Да',
    ]);
    ?>

    <?= $form->field($model, 'garage')->dropDownList([
        '0' => 'Нет',
        '1' => 'Да',
    ]);
    ?>

    <?= $form->field($model, 'erker')->dropDownList([
        '0' => 'Нет',
        '1' => 'Да',
    ]);
    ?>

    <?= $form->field($model, 'dacha')->dropDownList([
        '0' => 'Нет',
        '1' => 'Да',
    ]);
    ?>
    <?= $form->field($model, 'time_build')->textInput() ?>

    <?= $form->field($model, 'original_price')->textInput() ?>

    <?= $form->field($model, 'typeArray')->checkboxList(\common\models\Type::find()->select(['title', 'id'])->indexBy('id')->column()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
