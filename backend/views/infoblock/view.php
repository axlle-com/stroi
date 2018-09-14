<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Infoblock */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Infoblocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="infoblock-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'published',
            'favourites',
            'show_img',
            'watermark',
            'small_img',
            'tumb_img',
            'name',
            'title',
            'description:ntext',
            'purified_text:ntext',
            'created_at',
            'updated_at',
            'date_pub',
            'date_end',
            'general_photo',
        ],
    ]) ?>

</div>
