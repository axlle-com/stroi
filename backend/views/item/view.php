<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Item */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'render_id' => $model->render_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'render_id' => $model->render_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category_id',
            'render_id',
            'sitemap',
            'published',
            'favourites',
            'show_comments',
            'show_img',
            'show_img_post',
            'show_img_cat',
            'show_message',
            'show_data',
            'watermark',
            'small_img',
            'tumb_img',
            'media',
            'alias_item',
            'title',
            'title_seo',
            'title_short',
            'description_seo',
            'description:ntext',
            'purified_text:ntext',
            'created_at',
            'updated_at',
            'date_pub',
            'date_end',
            'general_photo',
            'position',
            'hits',
            'stars',
        ],
    ]) ?>

</div>
