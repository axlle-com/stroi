<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Search\ItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'render_id') ?>

    <?= $form->field($model, 'sitemap') ?>

    <?= $form->field($model, 'published') ?>

    <?php // echo $form->field($model, 'favourites') ?>

    <?php // echo $form->field($model, 'show_comments') ?>

    <?php // echo $form->field($model, 'show_img') ?>

    <?php // echo $form->field($model, 'show_img_post') ?>

    <?php // echo $form->field($model, 'show_img_cat') ?>

    <?php // echo $form->field($model, 'show_message') ?>

    <?php // echo $form->field($model, 'show_data') ?>

    <?php // echo $form->field($model, 'watermark') ?>

    <?php // echo $form->field($model, 'small_img') ?>

    <?php // echo $form->field($model, 'tumb_img') ?>

    <?php // echo $form->field($model, 'media') ?>

    <?php echo $form->field($model, 'alias_item') ?>

    <?php echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'title_seo') ?>

    <?php // echo $form->field($model, 'title_short') ?>

    <?php // echo $form->field($model, 'description_seo') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'purified_text') ?>

    <?php // echo $form->field($model, 'date_pub') ?>

    <?php // echo $form->field($model, 'date_end') ?>

    <?php // echo $form->field($model, 'general_photo') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php echo $form->field($model, 'hits') ?>

    <?php // echo $form->field($model, 'stars') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
