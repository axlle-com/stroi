<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Details */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="details-view">

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
            'item_id',
            'name',
            'same_item',
            'material',
            'initial_size',
            'square',
            'room',
            'floor',
            'mansard',
            'balcony',
            'krilco',
            'garage',
            'erker',
            'dacha',
            'original_price',
            'time_build',
        ],
    ]) ?>

</div>
