<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Item */
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
if($model->hits){
    $hits = $model->hits;
}else{
    $hits = 1;
}
if($model->stars){
    $stars = $model->stars;
}else{
    $stars = 0;
}
?>
<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?
    $category = common\models\Category::find()->all();
    $items = ArrayHelper::map($category,'id','title');
    $params = [
        'prompt' => 'Укажите категорию'
    ];
    echo $form->field($model, 'category_id')->dropDownList($items,$params);
    ?>

    <?
    $render = common\models\Render::find()->all();
    $items = ArrayHelper::map($render,'id','name');
    $params = [
        'prompt' => 'Укажите страницу вывода'
    ];
    echo $form->field($model, 'render_id')->dropDownList($items,$params);
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

    <?= $form->field($model, 'show_comments')->dropDownList([
        '0' => 'Нет',
        '1' => 'Да',
    ]);
    ?>

    <?= $form->field($model, 'show_img')->dropDownList([
        '1' => 'Да',
        '0' => 'Нет',
    ]);
    ?>

    <?= $form->field($model, 'show_img_post')->dropDownList([
        '1' => 'Да',
        '0' => 'Нет',
    ]);
    ?>

    <?= $form->field($model, 'show_img_cat')->dropDownList([
        '1' => 'Да',
        '0' => 'Нет',
    ]);
    ?>

    <?= $form->field($model, 'show_message')->dropDownList([
        '1' => 'Да',
        '0' => 'Нет',
    ]);
    ?>

    <?= $form->field($model, 'show_data')->dropDownList([
        '0' => 'Нет',
        '1' => 'Да',
    ]);
    ?>

    <?= $form->field($model, 'watermark')->dropDownList([
        '0' => 'Нет',
        '1' => 'Да',
        '2' => 'Аналог',
    ]);
    ?>

    <?= $form->field($model, 'small_img')->dropDownList([
        '1' => 'Да',
        '0' => 'Нет',
    ]);
    ?>

    <?= $form->field($model, 'tumb_img')->dropDownList([
        '1' => 'Да',
        '0' => 'Нет',
    ]);
    ?>

    <?= $form->field($model, 'media')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias_item')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_seo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_short')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description_seo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?//= $form->field($model, 'purified_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date_pub')->textInput(['value' => $date_pub, 'maxlength' => true]) ?>

    <?= $form->field($model, 'date_end')->textInput(['value' => $date_end, 'maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hits')->textInput(['value' => $hits, 'maxlength' => true]) ?>

    <?= $form->field($model, 'stars')->textInput(['value' => $stars]) ?>

    <?= $form->field($model, 'infoblockArray')->checkboxList(\common\models\Infoblock::find()->select(['title', 'id'])->indexBy('id')->column()) ?>

    <?if($alias_category = $model->category->alias_category){?>
        <?= $form->field($model, 'tagsArray')->checkboxList(\common\models\Tags::find()->where(['alias_category' => $alias_category])->select(['name', 'id'])->indexBy('id')->column()) ?>
    <?}else{?>
        <?= $form->field($model, 'tagsArray')->checkboxList(\common\models\Tags::find()->select(['name', 'id'])->indexBy('id')->column()) ?>
    <?}?>

    <div class="form-group">
        <?= Html::submitButton('Дальше', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
