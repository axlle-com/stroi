<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Tags */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tags-form">

    <?php $form = ActiveForm::begin(); ?>

    <? /*echo $form->field($model, 'sitemap')->textInput() */?>

    <?= $form->field($model, 'sitemap')->dropDownList([
        '1' => 'Показывать',
        '0' => 'Не показывать',
    ]);
    ?>

    <? /*echo $form->field($model, 'alias_category')->textInput(['maxlength' => true]) */?>

    <?
    $category = common\models\Category::find()->where(['parent_id' => 2])->all();
    $items = ArrayHelper::map($category,'alias_category','title');
    $params = [
        'prompt' => 'Укажите категорию'
    ];
    echo $form->field($model, 'alias_category')->dropDownList($items,$params);
    ?>

    <?= $form->field($model, 'alias_tags')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_short')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_seo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description_seo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?/*= $form->field($model, 'name')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'type')->textInput(['maxlength' => true]) */?>

    <?= $form->field($model, 'type')->dropDownList([
        '0' => 'Не показывать',
        'size' => 'Размер',
        'square' => 'Площадь',
        'features' => 'Конструктивные особенности',
        'price' => 'Стоимость',
        'floor' => 'Этажность',
        'type' => 'Тип',
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
