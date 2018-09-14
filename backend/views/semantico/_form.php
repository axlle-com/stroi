<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\helpers\HtmlPurifier;
/* @var $this yii\web\View */
/* @var $model common\models\Semantico */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="semantico-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'category_id')->textInput(['maxlength' => true]) ?>

    <?
    $category = common\models\Category::find()->all();
    $items = ArrayHelper::map($category,'id','title');
    $params = [
        'prompt' => 'Укажите категорию'
    ];
    echo $form->field($model, 'category_id')->dropDownList($items,$params);
    ?>

    <?//= $form->field($model, 'item_id')->textInput() ?>

    <?
    $item = common\models\Item::find()->all();
    $items = ArrayHelper::map($item,'id','title');
    $params = [
        'prompt' => 'Укажите статью'
    ];
    echo $form->field($model, 'item_id')->dropDownList($items,$params);
    ?>

    <?= $form->field($model, 'key_name')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_seo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description_seo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
