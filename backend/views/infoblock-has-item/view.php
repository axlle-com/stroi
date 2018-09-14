<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\InfoblockHasItem */

$this->title = $model->infoblock_id;
$this->params['breadcrumbs'][] = ['label' => 'Infoblock Has Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="infoblock-has-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'infoblock_id' => $model->infoblock_id, 'item_id' => $model->item_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'infoblock_id' => $model->infoblock_id, 'item_id' => $model->item_id], [
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
            'infoblock_id',
            'item_id',
        ],
    ]) ?>

</div>
