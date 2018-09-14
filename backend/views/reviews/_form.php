<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Reviews */
/* @var $form yii\widgets\ActiveForm */
if($model->data){
    $data = $model->data;
}else{
    $data = date('Y-m-d');
}
if($model->data_rev){
    $data_rev = $model->data_rev;
}else{
    $data_rev = date('Y-m-d');
}
?>

<div class="reviews-form">

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

    <?= $form->field($model, 'data')->textInput(['value' => $data]) ?>

    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?//= $form->field($model, 'positively')->textInput() ?>

    <?= $form->field($model, 'positively')->dropDownList([
        '1' => 'Да',
        '0' => 'Нет',
    ]);
    ?>

    <?= $form->field($model, 'media')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'show_img')->textInput() ?>

    <?= $form->field($model, 'show_img')->dropDownList([
        '0' => 'Нет',
        '1' => 'Да',
    ]);
    ?>

    <?//= $form->field($model, 'watermark')->textInput() ?>

    <?= $form->field($model, 'watermark')->dropDownList([
        '0' => 'Нет',
        '1' => 'Да',
        '2' => 'Аналог',
    ]);
    ?>

    <?//= $form->field($model, 'small_img')->textInput() ?>

    <?= $form->field($model, 'small_img')->dropDownList([
        '0' => 'Нет',
        '1' => 'Да',
    ]);
    ?>

    <?//= $form->field($model, 'tumb_img')->textInput() ?>

    <?= $form->field($model, 'tumb_img')->dropDownList([
        '0' => 'Нет',
        '1' => 'Да',
    ]);
    ?>

    <?//= $form->field($model, 'general_photo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_rev')->textInput(['value' => $data_rev]) ?>

    <?= $form->field($model, 'name_rev')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_rev')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description_rev')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
