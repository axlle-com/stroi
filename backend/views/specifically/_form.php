<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Specifically */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="specifically-form">

    <?php $form = ActiveForm::begin(); ?>
    <?
    $render = common\models\Type::find()->all();
    $items = ArrayHelper::map($render,'name','title');
    $params = [
        'prompt' => 'Укажите Тип'
    ];
    echo $form->field($model, 'title')->dropDownList($items,$params);
    ?>

    <?//= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'specialty')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'extra_id')->textInput() ?>

    <?
    $render = common\models\Extra::find()->all();
    $items = ArrayHelper::map($render,'id','markup');
    $params = [
        'prompt' => 'Укажите наценку'
    ];
    echo $form->field($model, 'extra_id')->dropDownList($items,$params);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
