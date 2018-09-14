<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\TagsHasItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tags-has-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'tags_id')->textInput() ?>

    <?
    $category = common\models\Tags::find()->all();
    $items = ArrayHelper::map($category,'id','name');
    $params = [
        'prompt' => 'Укажите тег'
    ];
    echo $form->field($model, 'tags_id')->dropDownList($items,$params);
    ?>

    <?//= $form->field($model, 'item_id')->textInput() ?>

    <?
    $category = common\models\Item::find()->all();
    $items = ArrayHelper::map($category,'id','title');
    $params = [
        'prompt' => 'Укажите статью'
    ];
    echo $form->field($model, 'item_id')->dropDownList($items,$params);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
