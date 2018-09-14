<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?
    $render = common\models\Render::find()->all();
    $items = ArrayHelper::map($render,'id','name');
    $params = [
        'prompt' => 'Укажите страницу вывода'
    ];
    echo $form->field($model, 'render_id')->dropDownList($items,$params);
    ?>

    <?
    $category = common\models\Category::find()->all();
    $items = ArrayHelper::map($category,'id','title');
    $params = [
        'prompt' => 'Укажите родительскую категорию'
    ];
    echo $form->field($model, 'parent_id')->dropDownList($items,$params);
    ?>

    <?= $form->field($model, 'sitemap')->dropDownList([
        '1' => 'Показывать',
        '0' => 'Не показывать',
    ]);
    ?>

    <?= $form->field($model, 'published')->dropDownList([
        '1' => 'Опубликовано',
        '0' => 'Не опубликовано',
    ]);
    ?>

    <?= $form->field($model, 'favourites')->dropDownList([
        '0' => 'Нет',
        '1' => 'Да',
    ]);
    ?>

    <?= $form->field($model, 'show_img')->dropDownList([
        '1' => 'Показывать',
        '0' => 'Не показывать',
    ]);
    ?>

    <?= $form->field($model, 'watermark')->dropDownList([
        '0' => 'Нет',
        '1' => 'Да',
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

    <?= $form->field($model, 'alias_category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_seo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_short')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description_seo')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'purified_text')->textarea(['rows' => 6]) ?>

    <?//= $form->field($model, 'general_photo')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'created_at')->textInput() ?>

    <?//= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
