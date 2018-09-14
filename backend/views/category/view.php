<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

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
            'render_id',
            'parent_id',
            'sitemap',
            'published',
            'favourites',
            'show_img',
            'watermark',
            'small_img',
            'tumb_img',
            'alias_category',
            'title',
            'title_seo',
            'title_short',
            'description:ntext',
            'description_seo',
            'purified_text:ntext',
            'general_photo',
            'sort',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
