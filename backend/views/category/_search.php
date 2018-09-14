<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Search\CategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'render_id') ?>

    <?= $form->field($model, 'parent_id') ?>

    <?= $form->field($model, 'sitemap') ?>

    <?= $form->field($model, 'published') ?>

    <?php // echo $form->field($model, 'favourites') ?>

    <?php // echo $form->field($model, 'show_img') ?>

    <?php // echo $form->field($model, 'watermark') ?>

    <?php // echo $form->field($model, 'small_img') ?>

    <?php // echo $form->field($model, 'tumb_img') ?>

    <?php echo $form->field($model, 'alias_category') ?>

    <?php echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'title_seo') ?>

    <?php echo $form->field($model, 'title_short') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'description_seo') ?>

    <?php // echo $form->field($model, 'purified_text') ?>

    <?php // echo $form->field($model, 'general_photo') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
